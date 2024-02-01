<!DOCTYPE html>
<html lang="it-IT">
  <head>
    <meta charset="utf-8" />
    <style>
        .button {
          border: none;
          color: white;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          padding: 2px;
          transition-duration: 0.4s;
          cursor: pointer;
        }

        .button1 {
          background-color: white;
          color: black;
          border: 2px solid #4CAF50;
        }

        .button1:hover {
          background-color: #4CAF50;
          color: white;
        }

        .button2 {
          background-color: white;
          color: black;
          border: 2px solid #008CBA;
        }

        .button2:hover {
          background-color: #008CBA;
          color: white;
        }

    </style>
  </head>
  <body>
      <img src="{{ asset('assets/media/logos/logo.png') }}" style="max-width:300px">
      <br>
      @if($locale =='it')
        <p>Ciao, hai ricevuto un invito da {{ $inviter }} ad utilizzare la piattaforma {{ config('values.APP_NAME')}}.
            <br>Registrati gratuitamente per utilizzare i servizi.
        </p>
        <p>Cordiali Saluti</p>
        <hr>
        <p style="text-align:justify">
            <small>
                Le informazioni contenute in questo messaggio di posta elettronica sono riservate, rivolte esclusivamente al destinatario e non comportano alcun vincolo né creano obblighi per la società mittente, salvo ciò che non sia espressamente previsto da un precedente accordo.
                    Ogni altra persona diversa dal destinatario non può copiare o consegnare il presente messaggio o parte dello stesso a terzi né trattare in alcun modo i dati contenuti.
                    La informiamo che l\' utilizzo non autorizzato del messaggio o dei suoi allegati potrebbe costituire reato.
                    Grazie per la collaborazione.
            <small>
        </p>
        <a class="button button1" href="{{ $link_accept }}">Accetta invito</a>
        <a class="button button2"  href="{{ $link_deny }}">Declina invito</a>

     @elseif( $locale =='es')

     <p> Hola, ha recibido una invitación de {{ $inviter }} para utilizar la plataforma {{ config('values.APP_NAME')}}.
         <br> Regístrese gratis para utilizar los servicios.
     </p>
     <p>Saludos cordiales</p>
     <hr>
     <p style = "text-align: justify">
         <small>
             La información contenida en este mensaje de correo electrónico es confidencial, está dirigida exclusivamente al destinatario y no conlleva ninguna limitación ni crea obligaciones para la empresa remitente, salvo lo que no esté expresamente previsto en un acuerdo previo.
                 Cualquier otra persona que no sea el destinatario no puede copiar o entregar este mensaje o parte de él a terceros ni procesar los datos contenidos en él de ninguna manera.
                 Le informamos que el uso no autorizado del mensaje o sus adjuntos podría constituir un delito.
                 Gracias por la colaboración.
         <small>
     </p>
     <a class="button button1" href="{{ $link_accept }}">Aceptar la invitacion </a>
     <a class="button button2"  href="{{ $link_deny }}">Rechazar invitación </a>

    @else
    <p>Hi, you have received an invitation from {{ $inviter }} to use the {{ config('values.APP_NAME')}} platform.
         <br>Register for free to use the services.
     </p>
     <p>Best Regards</p>
     <hr>
     <p style = "text-align: justify">
         <small>
             The information contained in this e-mail message is confidential, addressed exclusively to the recipient and does not entail any obligations or create obligations for the sending company, except for what is not expressly provided for in a previous agreement.
                 Any other person other than the recipient cannot copy or deliver this message or part of it to third parties or process the data contained in it in any way.
                 We inform you that the unauthorized use of the message or its attachments could constitute a crime.
                 Thanks for collaboration.
         <small>
     </p>
     <a class="button button1" href="{{ $link_accept }}">Accept invitation</a>
     <a class="button button2"  href="{{ $link_deny }}">Decline invitation</a>
    @endif

  </body>
</html>
