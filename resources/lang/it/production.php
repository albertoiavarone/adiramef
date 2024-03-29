<?php
return [

    'machine' => 'Macchina|Macchine',
    'machine_type' => 'Tipo Macchina|Tipi Macchine',
    'builder' => 'Costruttore|Costruttori',
    'program' => 'Programma|Programmi',
    'process' => 'Processo|Processi',
    'piece' => 'Pezzo|Pezzi',
    'work' => 'Lavorazione|Lavorazioni',
    'alarm' => 'Allarme|Allarmi',
    'option' => 'Opzione|Opzioni',
    'parameter' => 'Parametro|Parametri',
    'operator' => 'Operatore|Operatori',
    'serial_number' => 'Numero di serie',
    'date_start' => 'Data di inizio',
    'date_end' => 'Data di fine',
    'actual_time' => 'Tempo effettivo',
    'total_time' => 'Tempo totale',
    'purchase_date' => 'Data di acquisto',
    'sync' => 'Sincronizzazione|Sincronizzazioni',
    'diagnostics' => 'Diagnostica',
    'sync_production' => 'Sincronizza dati Macchina',
    'sync_diagnostics' => 'Aggiorna info Macchina',
    'last_work' => 'Ultima Lavorazione',
    'first_work' => 'Prima Lavorazione',
    'last_log' => 'Ultimo Log',
    'stats' => 'Statistiche',
    'production' => 'Produzione',
    'response_sync' => 'Esito della sincronizzazione',
    'sync_not_allowed' => 'Sincronizzazione non consentita',
    'date_from' => 'Data dal',
    'date_to' => 'Data al',
    'time_from' => 'Dalle ore',
    'time_to' => 'Alle ore',
    'work_info_box' => 'Archivio delle lavorazioni eseguite dai dispositivi.',
    'program_info_box' => 'Archivio dei programmi che sono stati eseguiti durante le lavorazioni...',
    'diagnostic_info_box' => 'Archivio dei log sullo stato delle macchine (esempio inizio/fine produzione, allarmi, etc).',
    'sync_info_box' => 'Archivio delle sincronizzazioni avvenute tra il MES ed i dispositivi collegati. Le sincronizzazioni possono riguardare sia i dati di produzione che di diagnostica, in base al dispostivo ed alle funzionalità correlate.',
    'schedule' => 'Pianificazione|Pianificazioni',
    'scheduled' => 'Pianificato|Pianificati',
    'schedule_info_box' => 'In questa sezione puoi pianificare una lavorazione per gli Impianti Fissi caricando i parametri di lavorazione.',
    'inserted_rows' => 'Righe inserite',
    'last_schedule' => 'Ultima pianificazione|Ultime pianificazioni',
    'manteinance' => 'Manutenzione|Manutenzioni',
    'manteinance_type' => 'Tipologia Manutenzione|Tipologie Manutenzioni',
    'manteinance_expiring' => 'Manutenzione in scadenza|Manutenzioni in scadenza',
    'energy_consumed' => 'Energia consumata',
    'plate' => 'Targa|Targhe',
    'telemetry' => 'Telemetria',
    'provider' => 'Provider|Providers',
    'gps' => 'Provvista di dispositivo GPS',
    'fuel' => 'Carburante consumato',
    'cost' => 'Importo',
    'localization' => 'Localizzazione|Localizzazioni',
    'address' => 'Indirizzo|Indirizzi',
    'wait_for_sync_msg' => 'Attendi circa #minutes# minuti per effettuare la sincronizzazione, potrebbe essere stata effettuata da poco tempo o il server potrebbe essere sovraccarico...',
    'not_permit_builder_delete' => 'Operazione non consentita. Ci sono macchine collegate a questo costruttore.',
    'not_permit_machine_type_delete' => 'Operazione non consentita. Ci sono macchine collegate a questa tipologia.',
    'info_machine_sync_refresh' => 'Le informazioni delle macchine  dotate di dispositivi GPS/GPRS vengono aggiornate quotidianamente e comunque (forzando l\'operazione dal pannello) non prima di '.config('values.MACHINE_INFO_REFRESH_TIME_MINUTES').' minuti dall\'ultimo aggiornamento.',
    'telemetry_machine_sync_refresh' => 'I dati della telemetria delle macchine dotate di dispositivi GPS/GPRS vengono aggiornate ogni 15 minuti e comunque (forzando l\'operazione dal pannello) non prima di '.config('values.MACHINE_TELEMETRY_REFRESH_TIME_MINUTES').' minuti dall\'ultima sincronizzazione.',
    'provider_no_gps_info' => 'Il provider selezionato non invia le coordinate nella lettura dei dati telemetrici, è possibile indicare Latitudine e Longitudine statiche, al fine di visualizzare il dispositivo sulla mappa.',
    'lot' => 'Lotto|Lotti',
    'prd_label' => 'Carico dopo Lavorazione Interna',
    'ref_id' => 'Ref. ID o Code',
    'order' => 'Ordine|Ordini',
];
