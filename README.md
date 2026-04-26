
# meal-finder

  

update de refeiçãõ atualiza os metadados e os embeddings

  

Descrição do projeto

  

Fazer as lojas funcionarem

  

usar pgsql:

image: 'pgvector/pgvector:pg16'

  

buildar o container - sail up -d --build

entrar no container:

psql

CREATE EXTENSION IF NOT EXISTS vector;

  

API do gpt:

Faz o pix 🤑🤑

  

Prism pra chamar a ia

  

sail art app:import-meals

  

Video demonstrativo

  
  
  
  
  

# Meal Finder

  

Aplicação Laravel que utiliza **busca semântica com embeddings de IA** para encontrar refeições a partir de descrições em linguagem natural. Em vez de depender de palavras-chave exatas, o sistema entende o significado da consulta do usuário.

  

Exemplo:

  

> Entrada: “algo leve com frango e sem lactose”

> Resultado: refeições semanticamente similares, mesmo sem conter exatamente essas palavras.

  
----------

 
## Requisitos

  

- Docker + Docker Compose

- PHP 8.2+ (opcional, ambiente local)

- Composer

- Conta na OpenAI com créditos disponíveis

----------

## Instalação

  

### 1. Clonar o projeto

  

```
git clone <seu-repositorio>
```


```
cd meal-finder
```

  

----------

  

### 2. Instalar dependências

  

```
composer install
```

  

----------

  

### 3. Configurar ambiente

  

```
cp .env.example .env
```

  

Atualize as variáveis necessárias (ver seção de variáveis abaixo).

DB_CONNECTION=pgsql

DB_HOST=pgsql

DB_PORT=5432

DB_DATABASE=meal_finder

DB_USERNAME=sail

DB_PASSWORD=secret

OPENAI_API_KEY=your_api_key_here

----------

  

### 4. Subir ambiente com Laravel Sail

  
```
./vendor/bin/sail up -d --build 
```


----------

  

### 5. Rodar migrations

  
```
./vendor/bin/sail artisan migrate
```  

----------

### 6. Gerar a key do laravel

  

```
./vendor/bin/sail artisan key:generate
```

  

### 6. fila laravel
```
./vendor/bin/sail artisan queue:work
```
----------

## Configuração do Banco de Dados


O projeto utiliza:


- PostgreSQL 16

- Extensão vetorial: **pgvector**

- Imagem Docker: `pgvector/pgvector:pg16`

  

----------

  

### 1. Subir container

```
./vendor/bin/sail up -d --build
```


----------

  

### 2. Acessar o container do banco

  
```
./vendor/bin/sail psql  
```
  ----------

  

### 3. Ativar extensão pgvector


Dentro do PostgreSQL:


```
CREATE EXTENSION IF NOT EXISTS vector;
```

  


## Teste com OpenAI

Este projeto utiliza o Prism PHP para integração com a IA. Para testar a geração de embeddings, siga os passos abaixo:

### 1. Acesse o container e abra o Tinker

```bash
sail tinker
```

### 2. Instancie o serviço de embeddings

```php
$service = new EmbeddingService();
```

### 3. Gere um embedding de teste

```php
$service->generateEmbedding("teste");
```

Se tudo estiver configurado corretamente, o comando retornará o embedding gerado para o texto informado.


Isso deve retorna um exemplo de embeddign.

### Observação importante

para conseguir gerar as as refeições com os embeddings certinho tem que ter as filas rodando e creditos na plataforma da open ia




  
----------

  
  

## Uso

  

Após subir o ambiente:
```
sail up -d && sail npm run dev
```
Acesse:

http://localhost

Digite uma descrição de refeição e veja os resultados retornados com base em similaridade semântica.# meat-finder

update de refeiçãõ atualiza os metadados e os embeddings

  

Descrição do projeto

  

Fazer as lojas funcionarem

  

usar pgsql:

image: 'pgvector/pgvector:pg16'

  

buildar o container - sail up -d --build

entrar no container:

psql

CREATE EXTENSION IF NOT EXISTS vector;

  

API do gpt:

Faz o pix 🤑🤑

  

Prism pra chamar a ia

  

sail art app:import-meals

  

Video demonstrativo

  
  
  
  
