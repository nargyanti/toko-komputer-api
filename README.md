# Toko Komputer API

Toko Komputer API is an API that is used to create, read, edit, and delete product data from the Toko Komputer that selling various needs.

## Relational Table
![Database design](/public/assets/images/readme/relational-table.png)

## Endpoint
### Authentication
```
POST    /register   Register to API
POST    /login      Log In to API
POST    /logout     Log Out from API
```
### Category
```
GET     /category                            Show categories created by auth user
GET     /category/sort_by_product_amount     Show categories created by auth user sort by product amount descending
```
### Product
```
GET     /product                 Show products created by auth user
GET     /product/sort_by_price   Show products created by auth user sort by price descending
POST    /product                 Add new product with multiple image
PUT     /product/{id}            Edit product
DELETE  /product/{id}            Delete product with its assets
```
### Product Asset
```
POST    /product                 Add new product asset
DELETE  /product/{id}            Delete product asset
```

## Screenshots
### Authentication
1. Register
![Register](/public/assets/images/readme/register.png)
2. Login
![Login](/public/assets/images/readme/login.png)
3. Logout
![Logout](/public/assets/images/readme/logout.png)

### Category
1. Show category
![Show category](/public/assets/images/readme/categories.png)
2. Show category sort by product amount
![Show categories sort by product amount](/public/assets/images/readme/categories-sort-by-product-amount.png)


### Product
1. Show products
![Show products](/public/assets/images/readme/products-with-assets.png)
2. Show products sort by price
![Show products sort by price](/public/assets/images/readme/products-sort-by-price.png)
3. Add product with multiple image
![Add product](/public/assets/images/readme/add-product.png)
4. Edit product 
![Edit product](/public/assets/images/readme/edit-product.png)
5. Delete product 
![Delete product](/public/assets/images/readme/delete-product.png)

### Product asset
1. Add new product asset 
![Add product asset](/public/assets/images/readme/add-product-asset.png)
2. Delete new product asset
![Delete product asset](/public/assets/images/readme/delete-product-asset.png)