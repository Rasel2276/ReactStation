-- Database
CREATE DATABASE IF NOT EXISTS multi_vendor_ecommerce;
USE multi_vendor_ecommerce;

-- =======================
-- 1. ROLES & USERS
-- =======================
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    role_id INT,
    status ENUM('Active','Inactive') DEFAULT 'Active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- =======================
-- 2. CATEGORY & SUBCATEGORY
-- =======================
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL,
    slug VARCHAR(120),
    description TEXT,
    category_image VARCHAR(255),
    status ENUM('Active','Inactive') DEFAULT 'Active'
);

CREATE TABLE subcategories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_category_id INT NOT NULL,
    subcategory_name VARCHAR(100) NOT NULL,
    slug VARCHAR(120),
    description TEXT,
    subcategory_image VARCHAR(255),
    status ENUM('Active','Inactive') DEFAULT 'Active',
    FOREIGN KEY (parent_category_id) REFERENCES categories(id)
);

-- =======================
-- 3. PRODUCTS
-- =======================
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(200) NOT NULL,
    sku VARCHAR(100),
    category_id INT,
    subcategory_id INT,
    vendor_id INT,
    price DECIMAL(10,2),
    stock_quantity INT DEFAULT 0,
    description TEXT,
    product_image VARCHAR(255),
    color VARCHAR(50),
    size VARCHAR(50),
    featured ENUM('Yes','No') DEFAULT 'No',
    status ENUM('Active','Inactive') DEFAULT 'Active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (subcategory_id) REFERENCES subcategories(id),
    FOREIGN KEY (vendor_id) REFERENCES users(id)
);

-- =======================
-- 4. PRODUCT ATTRIBUTES
-- =======================
CREATE TABLE product_attributes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    attribute_name VARCHAR(100),
    attribute_type VARCHAR(100),
    description TEXT,
    status ENUM('Active','Inactive') DEFAULT 'Active'
);

-- =======================
-- 5. DISCOUNTS
-- =======================
CREATE TABLE product_discounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    discount_type ENUM('Percentage','Fixed Amount'),
    discount_value DECIMAL(10,2),
    start_date DATE,
    end_date DATE,
    status ENUM('Active','Inactive') DEFAULT 'Active',
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- =======================
-- 6. CUSTOMER ORDERS
-- =======================
CREATE TABLE customer_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    total_payment DECIMAL(10,2),
    status ENUM('Pending','Processing','Completed','Cancelled') DEFAULT 'Pending',
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES users(id)
);

CREATE TABLE customer_order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    vendor_id INT,
    quantity INT,
    price DECIMAL(10,2),
    total DECIMAL(10,2) GENERATED ALWAYS AS (quantity * price) STORED,
    FOREIGN KEY (order_id) REFERENCES customer_orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (vendor_id) REFERENCES users(id)
);

-- =======================
-- 7. VENDOR PURCHASES (Admin → Vendor)
-- =======================
CREATE TABLE vendor_purchases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vendor_id INT NOT NULL,
    admin_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) GENERATED ALWAYS AS (quantity * price) STORED,
    status ENUM('Pending','Completed','Cancelled') DEFAULT 'Pending',
    purchase_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vendor_id) REFERENCES users(id),
    FOREIGN KEY (admin_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- =======================
-- 8. VENDOR RETURNS (Vendor → Admin)
-- =======================
CREATE TABLE vendor_returns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vendor_id INT NOT NULL,
    admin_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    reason TEXT,
    status ENUM('Pending','Approved','Rejected','Completed') DEFAULT 'Pending',
    return_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vendor_id) REFERENCES users(id),
    FOREIGN KEY (admin_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- =======================
-- 9. CUSTOMER RETURNS (Customer → Vendor)
-- =======================
CREATE TABLE customer_returns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_order_item_id INT NOT NULL,
    customer_id INT NOT NULL,
    vendor_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    reason TEXT,
    status ENUM('Pending','Approved','Rejected','Refunded') DEFAULT 'Pending',
    return_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_order_item_id) REFERENCES customer_order_items(id),
    FOREIGN KEY (customer_id) REFERENCES users(id),
    FOREIGN KEY (vendor_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- =======================
-- 10. REFUNDS (Separated)
-- =======================
CREATE TABLE vendor_refunds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vendor_return_id INT NOT NULL,
    admin_id INT NOT NULL,
    vendor_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    method ENUM('bKash','Nagad','Bank Transfer','PayPal','Stripe') DEFAULT 'bKash',
    status ENUM('Pending','Processed','Completed','Cancelled') DEFAULT 'Pending',
    refund_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vendor_return_id) REFERENCES vendor_returns(id),
    FOREIGN KEY (admin_id) REFERENCES users(id),
    FOREIGN KEY (vendor_id) REFERENCES users(id)
);

CREATE TABLE customer_refunds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_return_id INT NOT NULL,
    vendor_id INT NOT NULL,
    customer_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    method ENUM('bKash','Nagad','Bank Transfer','PayPal','Stripe') DEFAULT 'bKash',
    status ENUM('Pending','Processed','Completed','Cancelled') DEFAULT 'Pending',
    refund_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_return_id) REFERENCES customer_returns(id),
    FOREIGN KEY (vendor_id) REFERENCES users(id),
    FOREIGN KEY (customer_id) REFERENCES users(id)
);

-- =======================
-- 11. PAYMENT & TRANSACTIONS
-- =======================
CREATE TABLE payment_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    method_name VARCHAR(100) NOT NULL,
    status ENUM('Active','Inactive') DEFAULT 'Active'
);

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('Order','Payout','Refund'),
    user_id INT,
    related_id INT,
    amount DECIMAL(10,2),
    method VARCHAR(100),
    status ENUM('Pending','Completed','Failed') DEFAULT 'Pending',
    transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- =======================
-- 12. VENDOR PAYOUT REQUESTS
-- =======================
CREATE TABLE vendor_payout_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vendor_id INT,
    amount DECIMAL(10,2),
    method VARCHAR(100),
    account_info VARCHAR(255),
    status ENUM('Pending','Approved','Rejected','Paid') DEFAULT 'Pending',
    request_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vendor_id) REFERENCES users(id)
);

-- =======================
-- 13. PRODUCT REVIEWS
-- =======================
CREATE TABLE product_reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    reviewer_id INT,
    rating INT,
    comment TEXT,
    review_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Visible','Hidden') DEFAULT 'Visible',
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (reviewer_id) REFERENCES users(id)
);
