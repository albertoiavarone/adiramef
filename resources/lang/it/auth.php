<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'Credenziali non corrette.',
    'password' => 'La password non è corretta.',
    'throttle' => 'Troppi tentativi di accesso. Riprova tra :seconds secondi.',

    //password
    'confirm_password' => 'Conferma la tua password per continuare',
    'digit_password' => 'Digita la tua password per continuare',
    'set_new_password' => 'Reimposta una nuova Password',
    'already_reset' => 'Hai già reimpostato la password?',
    'continue' => 'Continua',
    'change_password' => 'Modifica Password',
    'current_password' => 'Password Attuale',

    //login
    'new_here' => 'Non hai un account?',
    'login' => 'Accedi',
    'log_with' => 'Accedi con',
    'forgot_password' => 'Dimenticato la password?',
    'or' => 'Oppure',
    'email_placeholder' => 'es. mario.rossi@email.it',
    'logout' => 'Esci',
    'logout_info' => 'Termina la sessione',
    'placeholder_name' => 'es. Mario Rossi',
    'placeholder_email' => 'es. m.rossi@example.it',
    'last_login_at' => 'Ultimo accesso',

    //register
    'register' => 'Registrati',
    'create_account' => 'Crea un Account',
    'already_member' => 'Ho già un account',
    'sign_in' => 'Accedi',
    'name' => 'Nome',
    'confirm' => 'Conferma',
    'password_rules' => 'Usa almeno 8 caratteri con un mix di lettere, numeri e simboli.',
    'agreeTerms' => 'Effettuando la registrazione, confermo di accettare Termini e condizioni, di aver letto la Informativa sulla privacy e di avere almeno 18 anni.',
    'terms' => 'Termini and Condizioni',

    //forgot-password
    'enter_email' => 'Inserisci la tua email per reimpostare la password.',
    'send_link_reset' => 'Continua',

    //two factor auth
    'mf_auth' => 'Autenticazione a due fattori',
    'mf_auth_info' => 'Aggiungi un secondo livello di sicurezza',
    'mf_enabled' => 'Autenticazione a due fattori è stata attivata.',
    'mf_disabled' => 'Autenticazione a due fattori è stata disattivata.',
    'mf_enable' => 'Abilita',
    'mf_disable' => 'Disabilita',
    'mf_not_enabled' => 'Autenticazione a due fattori non attiva...',
    'mf_enabled' => 'Autenticazione a due fattori è attiva; di seguito il QR code per configurare l\'App (es. Google Authenticator) o i codici di recupero nel caso non disponessi più dell\'App.',
    'mf_codes' => 'Codici di recupero:',
    'mf_verification' => 'Verifica in due passaggi',
    'mf_enter_code' => 'Inserisci il tuo codice di autenticazione per accedere',
    'mf_type_code' => 'Digita il tuo codice di sicurezza a 6 cifre',
    'mf_no_code' => 'Non hai ricevuto il codice?',
    'mf_type_recovery_code' => 'Digita Codice di Recupero',
    'mf_enter_recovery_code' => 'Inserisci il tuo codice di recupero per accedere',
    'mf_question' => 'Che cos\'è l\'autenticazione a due fattori e perché viene utilizzata??',
    'mf_answer' => 'L\'autenticazione a due fattori (2FA), a volte indicata come verifica in due passaggi o autenticazione a due fattori, è un processo di sicurezza in cui gli utenti forniscono due diversi fattori di autenticazione per verificare se stessi.
                    <br />2FA è implementato per proteggere meglio sia le credenziali di un utente che le risorse a cui l\'utente può accedere. L\'autenticazione a due fattori fornisce un livello di sicurezza più elevato rispetto ai metodi di autenticazione che
                    dipendono dall\'autenticazione a un fattore (SFA), in cui l\'utente fornisce un solo fattore, in genere una password o un passcode. I metodi di autenticazione a due fattori si basano su un utente che fornisce una password come primo fattore e
                    un secondo fattore diverso, di solito un token di sicurezza o un fattore biometrico, come un\'impronta digitale o una scansione facciale.
                    <br />L\'autenticazione a due fattori aggiunge un ulteriore livello di sicurezza al processo di autenticazione rendendo più difficile per gli aggressori accedere ai dispositivi o agli account online di una persona perché, anche se la password della vittima viene violata,
                    una password da sola non è sufficiente per superare l\'autenticazione dai un\'occhiata.',
    'mf_instructions' => '<p> Il modo migliore per proteggere i tuoi account è l\'autenticazione a due fattori o 2FA. Questo è un processo che fornisce ai servizi web un accesso secondario al proprietario dell\'account (tu) al fine di verificare un tentativo di accesso. Ecco come funziona: quando accedi a un servizio, utilizzi il tuo telefono cellulare per verificare la tua identità facendo clic su un collegamento tramite SMS/e-mail o digitando un numero inviato da un\'app di autenticazione.
                                </p> <h4> Cosa sono le app di autenticazione? </h4>
                                <p> Le app di autenticazione sono considerate più sicure degli SMS. Offrono anche flessibilità quando viaggi in un luogo senza servizio cellulare. Le opzioni più popolari includono Authy, Google Authenticator, Microsoft Authenticator e Hennge OTP (solo iOS). Queste app seguono principalmente la stessa procedura quando aggiungi un nuovo account: esegui la scansione di un codice QR associato al tuo account e viene salvato nell\'app. La prossima volta che accedi al tuo servizio o app, ti verrà chiesto un codice numerico; basta aprire l\'app di autenticazione per trovare il codice generato casualmente necessario per superare la sicurezza.</p>',
    'mf_codes_instructions' => 'Se perdi l\'accesso alle tue credenziali di autenticazione a due fattori, puoi utilizzare questi codici di ripristino per riottenere l\'accesso al tuo account.',
    //verify email
    'verify_email' => 'Verifica il tuo indirizzo email',
    'verify_email_msg' => 'Un nuovo link di verifica è stato inviato al tuo indirizzo email.',
    'chek_email' => 'Ti abbiamo inviato una mail per verificare l\'indirizzo email che hai inserito ed attivare l\'account.<br />Il link nella mail ha una validità di 24 ore.',
    'not_received' => 'Se non hai ricevuto l\'email',
    'verify_resend' => 'clicca qui per riceverne un\'altra',

    //provider
    'update_password_oauth' => 'Hai effettuato l\'accesso tramite ##provider## senza digitare la password; per settare la password
        per la prima volta devi uscire dall\'app cliccare su password dimenticata',

];
