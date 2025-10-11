Table users {
    id int [pk, increment]
    name varchar
    email varchar [unique]
    password varchar
    role_id int [ref: > roles.id]
    created_at datetime
    updated_at datetime
}

Table roles {
    id int [pk, increment]
    role_name varchar
    created_at datetime
    updated_at datetime
}

Table products {
    id int [pk, increment]
    name varchar
    description text
    price decimal
    category_id int [ref: > categories.id]
    user_id int [ref: > users.id]
    stock_quantity int
    created_at datetime
    updated_at datetime
}

Table categories {
    id int [pk, increment]
    category_name varchar
    parent_id int [ref: > categories.id, null]
    created_at datetime
    updated_at datetime
}

Table product_attributes {
    id int [pk, increment]
    product_id int [ref: > products.id]
    attribute_name varchar
    attribute_value varchar
    created_at datetime
    updated_at datetime
}

Table product_reviews {
    id int [pk, increment]
    product_id int [ref: > products.id]
    user_id int [ref: > users.id]
    rating int
    review text
    created_at datetime
    updated_at datetime
}

Table orders {
    id int [pk, increment]
    user_id int [ref: > users.id]
    total_amount decimal
    payment_status varchar
    shipment_status varchar
    created_at datetime
    updated_at datetime
}

Table order_items {
    id int [pk, increment]
    order_id int [ref: > orders.id]
    product_id int [ref: > products.id]
    quantity int
    price decimal
    created_at datetime
    updated_at datetime
}

Table cart {
    id int [pk, increment]
    user_id int [ref: > users.id]
    created_at datetime
    updated_at datetime
}

Table cart_items {
    id int [pk, increment]
    cart_id int [ref: > cart.id]
    product_id int [ref: > products.id]
    quantity int
    created_at datetime
    updated_at datetime
}

Table payments {
    id int [pk, increment]
    order_id int [ref: > orders.id]
    payment_method varchar
    payment_status varchar
    transaction_id varchar
    amount decimal
    created_at datetime
    updated_at datetime
}

Table shipping {
    id int [pk, increment]
    order_id int [ref: > orders.id]
    shipping_method varchar
    shipping_status varchar
    tracking_number varchar
    created_at datetime
    updated_at datetime
}

Table discounts {
    id int [pk, increment]
    discount_code varchar
    discount_amount decimal
    expiry_date datetime
    created_at datetime
    updated_at datetime
}

Table wishlist {
    id int [pk, increment]
    user_id int [ref: > users.id]
    created_at datetime
    updated_at datetime
}

Table wishlist_items {
    id int [pk, increment]
    wishlist_id int [ref: > wishlist.id]
    product_id int [ref: > products.id]
    created_at datetime
    updated_at datetime
}