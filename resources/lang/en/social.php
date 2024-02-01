<?php
return [
    'invite' => 'Invite User',
    'invitations' => 'Invitations',
    'shares' => 'Shares',
    'request' => 'Request',
    'address_book' => 'Address Book',
    'guest' => 'Guest',
    'sender' => 'Sender',
    'pending' => 'Pending',
    'accepted' => 'Accepted',
    'enabled' => 'Enabled',
    'disabled' => 'Disabled',
    'rejected' => 'Rejected',
    'registered' => 'Registered',
    'removed' => 'Removed',
    'reactivated' => 'Reactivated',
    'already_shared' => 'Already shared',
    'shared' => 'Shared',
    'shared_by' => 'Shared by',
    'sendings' => 'Sendings',
    'send' => 'Send',
    'sent' => 'Sent',
    'sending_info' => 'Invite your friends or colleagues to use our application; once the recipient has registered, you will be able to share Accounts and notifications.',

    'email_invitation_subject' => '#sender# invites you to subscribe to '.config('values.APP_NAME'),
    'email_invitation_sent' => 'Invitation sent successfully',
    'max_invitation_sendings' => 'Reached the maximum number of mailings to this email address ('.config('values.MAX_INVITATION_SENDINGS').').',
    'invitation_denied' => 'You declined the invitation he sent you ',
    'account_sharing' => 'Account sharing',
    'new_sharing_request' => 'New invitation to share',
    'send_sharing_request' => 'Send invitation to share',
    'sharing_email_recipient' => 'User email with which to share the account',
    'sharing_rules' => 'The user to share the account with must already be a platform user; if not, you can invite him to register completely free of charge.',
    'no_accounts_to_share' => 'No accounts to share',

    'email_sharing_request_subject' => '#sender# invites you to share his accounts',
    'email_sharing_request_body' => '<p>Hi #recipient#, <br> you have received an invitation from #sender# to share Accounts; log in to the platform to view the details and manage the request.
                                        <br><br>Greetings</p>',
    'email_sharing_request_sent' => 'Request sent successfully',
    'enable' => 'Enable',
    'disable' => 'Disable',
    'reject' => 'Reject',
    'reactivate_rules' =>'Only the account holder can reactivate sharing',

    'pending_invitation' => 'You have an invitation to share an Account',
    'pending_invitations' => 'You have #invitations# invitations to share an Account',
];
