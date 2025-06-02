# KenzAtlas

KenzAtlas is a dynamic e-commerce platform designed for selling beauty and wellness products. The platform includes features such as product browsing, shopping cart management, user authentication, and order confirmation.

## Features

### User Features
- **Product Browsing**: Explore products by categories such as "Corps," "Beauté," and "Cheveux."
- **Shopping Cart**: Add, update, and remove items from the cart.
- **Checkout**: Secure checkout process with order confirmation.
- **User Authentication**: Register, log in, and sign out.
- **Order History**: View past orders.

### Admin Features
- **Dashboard**: Monitor daily views, sales, comments, and earnings.
- **User Management**: Manage user accounts and permissions.
- **Product Management**: Add, update, and delete products.
- **Reports**: Generate sales and user activity reports.

### Frontend Features
- **Responsive Design**: Optimized for various screen sizes.
- **Animations**: Smooth transitions and interactive elements.
- **Dark/Light Mode**: Theme toggle for better user experience.

## Technologies Used

### Backend
- **PHP**: Core backend logic.
- **MySQL**: Database for storing user, product, and order data.

### Frontend
- **HTML5**: Structure and content.
- **CSS3/SCSS**: Styling with variables and modular design.
- **JavaScript**: Interactivity and dynamic behavior.
- **Bootstrap**: Responsive design framework.

### Tools
- **SASS**: CSS preprocessor for modular styling.
- **Ionicons**: Icon library for UI elements.

## Project Structure

```
KenzAtlas/
├── .htaccess
├── A-Propos.php
├── article.php
├── aside.php
├── blog.php
├── boutique.php
├── checkout.php
├── confirmation-ordre.php
├── connection.php
├── contact.php
├── error.php
├── footer.php
├── index.php
├── mes-commandes.php
├── navbar.php
├── package.json
├── panier.php
├── Politique-de-Confidentialite.php
├── produit.php
├── README.md
├── signout.php
├── terms-conditions.php
├── thank-you.php
├── user.php
├── .vscode/
│   └── settings.json
├── admin/
│   └── index.php
├── assets/
│   └── img/
├── cms/
├── css/
│   ├── style.css
│   ├── style.css.map
│   ├── style.min.css
├── js/
│   ├── addToCart.js
│   ├── cart.js
│   ├── checkout.js
│   └── explore.js
├── kenzatlasAdmin/
├── sass/
│   ├── pages/
│   │   ├── index.scss
│   │   └── contact.scss
```

## How to Run

1. Clone the repository:
   ```bash
   git clone <repository-url>
   ```
2. Set up a MySQL database and import the schema.
3. Update database credentials in `connection.php`.
4. Compile SCSS to CSS using the script defined in `package.json`:
   ```bash
   npm run sass
   ```
5. Start a local server (e.g., XAMPP or WAMP) and place the project in the server's root directory.
6. Open `index.php` in your browser.



## External Libraries

- [Font Awesome](https://fontawesome.com/)
- [Ionicons](https://ionic.io/ionicons)
- [Bootstrap](https://getbootstrap.com/)

