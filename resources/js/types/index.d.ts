export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
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

export interface UserForm extends Omit<User, 'creator_id'>, Form {
    _method?: string;
}

interface Flash {
    errors?: string[];
    error?: string;
    warning?: string;
    success?: string;
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

export interface Product {
    id: number;
    creator_id: number;
    name: string;
    internal_id: string;
    quantity_france: number;
    minimum_quantity: number;
    quantity_netherlands: number;
    creator?: User;
    change_logs?: ChangeLog[];
}

export interface ProductForm extends Omit<Product, 'creator_id'>, Form {
    _method?: string;
}

export interface ProductFranceForm extends Form {
    id: number;
    name: string;
    quantity_france: number;
}