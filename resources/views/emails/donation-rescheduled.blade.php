<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reagendamento de Doação</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f39c12;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 10px;
        }
        .title {
            color: #2c3e50;
            font-size: 28px;
            margin: 0;
        }
        .subtitle {
            color: #7f8c8d;
            font-size: 16px;
            margin: 10px 0 0 0;
        }
        .content {
            margin-bottom: 30px;
        }
        .reschedule-info {
            background-color: #fef9e7;
            border-left: 4px solid #f39c12;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .donation-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #ecf0f1;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #2c3e50;
        }
        .detail-value {
            color: #34495e;
        }
        .next-steps {
            background-color: #e8f5e8;
            border-left: 4px solid #27ae60;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .next-steps h3 {
            color: #27ae60;
            margin-top: 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ecf0f1;
            color: #7f8c8d;
            font-size: 14px;
        }
        .contact-info {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .highlight {
            background-color: #fff3cd;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">🏠 Lar dos Idosos</div>
            <h1 class="title">Reagendamento Necessário</h1>
            <p class="subtitle">Precisamos reagendar sua doação</p>
        </div>

        <div class="content">
            <p>Olá <strong>{{ $doacao->nome }}</strong>,</p>
            
            <p>Entramos em contato para informar que precisamos reagendar sua doação. Pedimos desculpas por qualquer inconveniente.</p>

            <div class="reschedule-info">
                <h3 style="margin-top: 0; color: #f39c12;">📅 Informações do Reagendamento</h3>
                
                @if($reason)
                    <p><strong>Motivo do reagendamento:</strong></p>
                    <p>{{ $reason }}</p>
                @else
                    <p><strong>Motivo:</strong> Por questões operacionais, precisamos ajustar nossa agenda de coletas.</p>
                @endif

                @if($newDate)
                    <p><strong>Nova data sugerida:</strong> <span class="highlight">{{ $newDate }}</span></p>
                    <p>Se esta data não for conveniente para você, nossa equipe entrará em contato para encontrar um horário que funcione para ambas as partes.</p>
                @else
                    <p><strong>Próximos passos:</strong> Nossa equipe entrará em contato em breve para agendar uma nova data que seja conveniente para você.</p>
                @endif
            </div>

            <div class="donation-details">
                <h3 style="margin-top: 0; color: #2c3e50;">📋 Detalhes da Doação</h3>
                
                <div class="detail-row">
                    <span class="detail-label">Tipo de Doação:</span>
                    <span class="detail-value">{{ $doacao->tipo_doacao_formatado }}</span>
                </div>

                @if($doacao->valor)
                <div class="detail-row">
                    <span class="detail-label">Valor:</span>
                    <span class="detail-value">{{ $doacao->valor_formatado }}</span>
                </div>
                @endif

                @if($doacao->descricao_itens)
                <div class="detail-row">
                    <span class="detail-label">Itens:</span>
                    <span class="detail-value">{{ $doacao->descricao_itens }}</span>
                </div>
                @endif

                <div class="detail-row">
                    <span class="detail-label">Data da Solicitação:</span>
                    <span class="detail-value">{{ $doacao->created_at->format('d/m/Y H:i') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Endereço:</span>
                    <span class="detail-value">{{ $doacao->logradouro }}, {{ $doacao->numero }}, {{ $doacao->bairro }}, {{ $doacao->cidade }}/{{ $doacao->estado }}</span>
                </div>
            </div>

            <div class="next-steps">
                <h3>📝 O que acontece agora?</h3>
                <ul>
                    <li>Nossa equipe entrará em contato por telefone em até 24 horas</li>
                    <li>Vamos encontrar uma nova data que seja conveniente para você</li>
                    <li>Você receberá uma confirmação por e-mail com a nova data</li>
                    <li>Sua doação continuará sendo muito importante para nós!</li>
                </ul>
            </div>

            <div class="contact-info">
                <h4 style="margin-top: 0; color: #2c3e50;">📞 Precisa Falar Conosco?</h4>
                <p>Se você tiver alguma dúvida ou preferir entrar em contato diretamente:</p>
                <p><strong>E-mail:</strong> contato@laridosos.org.br<br>
                <strong>Telefone:</strong> (42) 3446-1234<br>
                <strong>WhatsApp:</strong> (42) 99999-9999</p>
                <p><em>Horário de atendimento: Segunda a Sexta, das 8h às 17h</em></p>
            </div>

            <p style="margin-top: 30px; text-align: center; font-style: italic; color: #7f8c8d;">
                Agradecemos sua compreensão e paciência. Sua doação é muito valiosa para nós!
            </p>
        </div>

        <div class="footer">
            <p><strong>Lar dos Idosos de Prudentópolis</strong></p>
            <p>Cuidando com amor e dedicação desde 1985</p>
            <p style="font-size: 12px; margin-top: 15px;">
                Este é um e-mail automático, por favor não responda diretamente.
            </p>
        </div>
    </div>
</body>
</html>

