# How to make JWT working

1. in the `.env.local` file set your `JWT_PASSPHRASE` with plaintext value
2. call the route `/api/login_check` with `POST` HTTP verb
3. use a body with such an object: `{"username": "Client n°2","password": "34521"}` 