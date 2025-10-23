# 📧 Sistema de E-mails - Lar dos Idosos

## 🎯 Momentos de Envio

### 1. **Doação Registrada** 
- **Arquivo:** `app/Http/Controllers/DonationController.php` (linha 212)
- **Ação:** Usuário finaliza doação
- **E-mail:** `DonationConfirmation`
- **Para:** Doador

### 2. **Doação Aceita**
- **Arquivo:** `app/Http/Controllers/AdminController.php` (linha 54)
- **Ação:** Admin clica "Aceitar"
- **E-mail:** `DonationStatusChanged`
- **Para:** Doador

### 3. **Doação Recusada**
- **Arquivo:** `app/Http/Controllers/AdminController.php` (linha 80)
- **Ação:** Admin clica "Recusar"
- **E-mail:** `DonationStatusChanged`
- **Para:** Doador

### 4. **Doação Reagendada**
- **Arquivo:** `app/Http/Controllers/AdminController.php` (linha 111)
- **Ação:** Admin clica "Reagendar"
- **E-mail:** `DonationRescheduled`
- **Para:** Doador

### 5. **Doação Recebida**
- **Arquivo:** `app/Http/Controllers/AdminController.php` (linha 141)
- **Ação:** Admin clica "Recebida"
- **E-mail:** `DonationStatusChanged`
- **Para:** Doador

### 6. **Status Alterado Manualmente**
- **Arquivo:** `app/Http/Controllers/AdminController.php` (linha 181)
- **Ação:** Admin muda status no dropdown
- **E-mail:** `DonationStatusChanged`
- **Para:** Doador

## 🔧 Configuração Atual

### Modo Desenvolvimento
- **Driver:** `log`
- **Local:** `storage/logs/laravel.log`
- **Resultado:** E-mails salvos em arquivo (não enviados)

### Para Produção
Alterar no arquivo `.env`:
```
MAIL_MAILER=smtp
MAIL_HOST=seu-servidor-smtp
MAIL_PORT=587
MAIL_USERNAME=seu-email
MAIL_PASSWORD=sua-senha
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contato@laridosos.org.br
MAIL_FROM_NAME="Lar dos Idosos"
```

## 📋 Templates de E-mail

### Localizações:
- `resources/views/emails/donation-confirmation.blade.php`
- `resources/views/emails/donation-status-changed.blade.php`
- `resources/views/emails/donation-rescheduled.blade.php`

### Características:
- **Design responsivo**
- **Cores do sistema**
- **Informações completas da doação**
- **Links e contatos**
- **Branding do Lar dos Idosos**

## 🛡️ Tratamento de Erros

Todos os envios têm tratamento de erro:
```php
try {
    Mail::to($doacao->email)->send(new DonationConfirmation($doacao));
} catch (\Exception $e) {
    \Log::warning('Erro ao enviar e-mail:', [
        'doacao_id' => $doacao->id,
        'error' => $e->getMessage()
    ]);
}
```

Se falhar, o sistema continua funcionando e registra o erro no log.

