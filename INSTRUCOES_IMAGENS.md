# 📸 Instruções para Adicionar Imagens no Carrossel

## 🎯 Como Adicionar Imagens

### 1. **Preparar as Imagens**
- **Tamanho recomendado**: 1000x500 pixels (proporção 2:1)
- **Formato**: JPG, PNG ou WebP
- **Qualidade**: Boa resolução, mas otimizada para web
- **Peso**: Máximo 500KB por imagem

### 2. **Onde Colocar as Imagens**
- Coloque as imagens na pasta: `public/images/carousel/`
- Crie a pasta se não existir

### 3. **Nomes das Imagens**
Use estes nomes específicos:
- `atividades-recreativas.jpg` - Para atividades com idosos
- `cuidado-medico.jpg` - Para equipe médica
- `alimentacao.jpg` - Para cozinha/refeitório
- `equipe.jpg` - Para foto da equipe
- `ambiente.jpg` - Para instalações do lar

### 4. **Como Atualizar o Código**

Abra o arquivo: `resources/views/home.blade.php`

Encontre a seção do carrossel e substitua os placeholders:

#### **Exemplo para a primeira imagem:**
```html
<!-- ANTES (placeholder) -->
<div class="image-placeholder">
    <div class="placeholder-icon">📸</div>
</div>

<!-- DEPOIS (imagem real) -->
<img src="/images/carousel/atividades-recreativas.jpg" alt="Atividades recreativas com idosos">
```

#### **Faça isso para todas as 5 imagens:**

1. **Atividades Recreativas** (linha ~61)
2. **Cuidado Médico** (linha ~75)
3. **Alimentação** (linha ~89)
4. **Equipe** (linha ~103)
5. **Ambiente** (linha ~117)

### 5. **Estrutura Final**
```
public/images/carousel/
├── atividades-recreativas.jpg
├── cuidado-medico.jpg
├── alimentacao.jpg
├── equipe.jpg
└── ambiente.jpg
```

## 🎨 Dicas para as Imagens

### **Atividades Recreativas**
- Idosos participando de jogos, dança, artesanato
- Momentos de alegria e socialização
- Evite fotos de idosos sozinhos

### **Cuidado Médico**
- Equipe médica atendendo
- Consultórios ou áreas de atendimento
- Profissionais em ação

### **Alimentação**
- Cozinha ou refeitório
- Preparação de refeições
- Idosos se alimentando (com permissão)

### **Equipe**
- Foto da equipe completa
- Funcionários em uniforme
- Ambiente de trabalho

### **Ambiente**
- Instalações do lar
- Quartos, salas comuns
- Áreas externas (jardim, etc.)

## ⚠️ Importante

1. **Sempre peça permissão** para usar fotos dos idosos
2. **Respeite a privacidade** - evite fotos muito íntimas
3. **Teste no site** após adicionar cada imagem
4. **Mantenha backup** das imagens originais

## 🔧 Testando

Após adicionar as imagens:
1. Acesse: `http://localhost:8000/`
2. Verifique se o carrossel está funcionando
3. Teste a navegação (setas e pontos)
4. Verifique no celular também

## 📞 Suporte

Se tiver dúvidas, consulte o desenvolvedor ou mantenha os placeholders até ter as imagens prontas.
