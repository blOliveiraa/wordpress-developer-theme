# Wordpress Template Base

Esse template tem por objetivo ser uma ferramenta para inicialização de um projeto wordpress de forma rápida para desenvolvedores, o tema é totalmente limpo, contendo os arquivos base e pré-configurado para utilização de SASS, além da minificação de arquivos para melhor otimização, evitando o uso de plugins para performance e SEO do sites desenvolvidos.

## Sumário

1) Como utilizar em desenvolvimento?

## 1) Como utilizar em desenvolvimento?

##### Requisitos:

- Node 18^ com NPM ou Yarn
- Docker
- Gulp


a) Clone esse repositório


b) Instale as dependências


c) Crie um arquivo env com os parametros a seguir:

{
    "mappings": {
        "wp-content/plugins": "./plugins",
        "wp-content/themes/{yourTheme}": "./"
    }
}