<?php

namespace App\Http\Controllers;

use App\Mail\MailController;
use App\Models\Place;
use App\Models\Show;
use App\Models\Show_User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Resources\Preference\BackUrls;
use MercadoPago\Resources\Preference\RedirectUrls;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CompraController extends Controller
{
    public function detalle(Request $request)
    {
        if (Auth::user()) {
            if (Auth::user()->admin === 1) {
                return redirect()->route('admin');
            }

            
            $sector = $request->sector;
            $cantidad = $request->cantidad;
            $show_id = $request->show_id;
            $place_id = $request->place_id;

            
            $request->validate([
                'sector' => 'required|string|max:255',
                'cantidad' => 'required|integer|min:1|max:4',
                'show_id' => 'required',
                'place_id' => 'required',
            ]);

            $show = Show::find($show_id);
            $place = Place::find($place_id);

           

            $disponibilidad = $show->{'disponibilidad_' . $sector};

            if ($cantidad > $disponibilidad) {
                
                return redirect()->back()->with('error', 'No hay suficientes entradas disponibles para el sector seleccionado.');
            }

            
            if ($sector == 'campo') {
                $precio = $show->precio;
            } elseif ($sector == 'vip') {
                $precio = $show->precio * 2;
            } else {
                $precio = $show->precio * 1.5;
            }

            
            
            MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

           
            $title = '"' . $show->artista .'"'. ' Sector: ' . strtoupper($sector);
            $descripcion = '"' . $show->artista . '" Sector: ' . strtoupper($sector) . 'Cantidad: ' . $cantidad;

           
            $client = new PreferenceClient();

            // Crear preferencia
           

                    $preference = $client->create([
                        "back_urls"=>array(
                            "success" => route('exito', ['show_id' => $show->id, 'sector' => $sector, 'cantidad' => $cantidad]),
                            "failure" => route('home'),
                            "pending" => route('home')
                        ), 
                       
                        
                        "expires" => false,
                        "items" => array(
                            array(
                                
                                "title" => $title,
                                "category_id" => "Entradas",
                                "quantity" => intval($cantidad),
                                "unit_price" => floatval($precio)
                            )
                        ),
                        "binary_mode" => true,
                        "auto_return" => "all",
                        "query" => $show->id,
                        
                    ]);
                        
                    
       
                

            
            return view('show.detalle', compact('sector', 'cantidad', 'show', 'place', 'precio', 'preference'));
        }

        return redirect()->route('login');
    }


    public function exito(Request $request){

        // Verificar si el pago fue aprobado
        
        if($request->status == 'approved'){
            
            $show_id = $request->input('show_id');
            $sector = $request->input('sector');
            $cantidad = $request->input('cantidad');
            $payment_id = $request->payment_id; 
            // Verificar si ya existe una compra con el mismo payment ID
            $existingPurchase = Show_User::where('payment_id', $payment_id)->first();
    
            if($existingPurchase){
                
                return redirect()->route('home');
            }
    
            // Actualizar la disponibilidad de entradas
            $show = Show::find($show_id);
            $show->{'disponibilidad_' . $sector} = $show->{'disponibilidad_' . $sector} - $cantidad;
            $show->save();
    
            // Crear y guardar las entradas en la base de datos
            $entradas = [];
            for($i = 0; $i < $cantidad; $i++){
                $show_user = new Show_User();
                $show_user->user_id = Auth::user()->id;
                $show_user->show_id = $show_id;
                $show_user->codigo_qr = uniqid(); // Usar el payment ID
                $show_user->sector = $sector;
                $show_user->payment_id = $request->payment_id;
                $qrCode = QrCode::format('png')->size(200)->generate(uniqid());
                
                $qrFileName = $show_user->codigo_qr . '.png';
                $qrDirectory = 'images/qrs/';
                if (!Storage::exists($qrDirectory)) {
                    Storage::makeDirectory($qrDirectory);
                }
                Storage::put($qrDirectory.$qrFileName, $qrCode );
               
                $show_user->qr_ruta = $qrDirectory. $qrFileName;
                $show_user->save();
                $entradas[] = $show_user;
            }
    
            
            Mail::to(Auth::user()->email)->send(new MailController([
                'nombre' => Auth::user()->nombre, 
                'entradas' => $entradas,
            ]));
    
            
            return redirect()->route('home')->with('success', '¡Compra exitosa! Tus entradas se encuentran en "Mi Cuenta"');
        }
        return redirect()->route('home');

    }
}
