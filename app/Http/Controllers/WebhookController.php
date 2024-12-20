<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Verificar la firma del webhook (seguridad)
        $signature = $request->header('X-Twilio-Signature');
        $url = $request->fullUrl();
        $params = $request->except('signature');
        $valid = $this->validateRequest($signature, $url, $params);

        if (!$valid) {
            return response()->json(['message' => 'Invalid request'], 400);
        }

        // Obtener los datos del mensaje
        $from = $request->input('From');
        $body = $request->input('Body');

        // Procesar el mensaje
        // ... (Aquí puedes guardar el mensaje en una base de datos, enviar una respuesta, etc.)

        // Enviar una respuesta a Twilio (opcional)
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $twilio->messages->create(
            $from, // Número al que se envía la respuesta
            ['body' => 'Mensaje recibido', 'from' => env('TWILIO_WHATSAPP_NUMBER')]
        );

        return response()->json(['message' => 'Webhook processed successfully']);
    }

    private function validateRequest($signature, $url, $params)
    {
        // Implementar la lógica para validar la firma del webhook
        // ...
        return true; // Por ahora, asumimos que la solicitud es válida
    }
}