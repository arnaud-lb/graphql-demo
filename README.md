# GraphQL demo

A Symfony application demoing a simple GraphQL API with [Overblog GraphQLBundle](https://github.com/overblog/GraphQLBundle).

## Install

```
git clone https://github.com/arnaud-lb/graphql-demo.git
composer install
php -S 127.0.0.1:8080 -t public/
```

Then, go to 127.0.0.1:8080/graphiql

## Powered by

- Overblog GraphQLBundle: https://github.com/overblog/GraphQLBundle
- Alice data fixtures: [nelmio/alice](https://github.com/nelmio/alice) / [AliceBundle](https://github.com/hautelook/AliceBundle) / [theofidry/AliceDataFixtures](https://github.com/theofidry/AliceDataFixtures)
- Doctrine: https://github.com/doctrine/doctrine2

## TODO

- Proper error reporting
- Count field on a connection
