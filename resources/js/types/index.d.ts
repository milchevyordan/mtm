import {Warehouse} from "@/Enums/Warehouse";

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
        notificationsCount: number;
    };
};

export type FormMethod = {
    _method?: string;
};

export type Form = {
    [key: string]: any;
};

export type Enum<T> = T[keyof T];

export interface User {
    id: number;
    creator_id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    creator?: User;
    change_logs?: ChangeLog[];
}

export interface UserForm extends Omit<User, 'creator_id'>, Form, FormMethod {
}

export interface ChangeLog {
    id: string;
    creator_id: number;
    creator: User;
    changeable_type: string;
    changeable_id: number;
    change: string;
    created_at: string;
}

interface ChangeLogsChange {
    old: string;
    new: string;
}

export interface ProductQuantity {
    id: number;
    product_id: number;
    warehouse: Enum<typeof Warehouse>;
    quantity: number;
    Varna?: number;
    France?: number;
    Netherlands?: number;
}

export interface ProductQuantityForm extends ProductQuantity, Form, FormMethod {
}

export interface Product {
    id: number;
    creator_id: number;
    name: string;
    internal_id: string;
    minimum_quantity: number;
    quantity: ProductQuantity[];
    quantities: {
        Varna: number;
        France: number;
        Netherlands: number;
    };
    creator?: User;
    change_logs?: ChangeLog[];
}

export interface ProductForm extends Omit<Product, "creator_id", "quantity">, Form, FormMethod {
}