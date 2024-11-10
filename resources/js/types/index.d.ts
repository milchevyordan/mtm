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

export interface Option {
    name: string;
    value: string | number | null;
}

export interface SelectInput {
    name: string;
    value: number | number[];
}

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

export interface DeleteForm {
    id: number,
    name: string,
    created_at: Date,
}

export interface ProductProject {
    id?: number;
    product_id: number;
    project_id: number;
    quantity: number;
    product?: Product;
    project?: Project;
    readonly created_at?: Date;
}

export interface ProductProjectForm extends ProductProject, Form, FormMethod {
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

export interface Project {
    id: number;
    creator_id: number;
    warehouse: Enum<typeof Warehouse>;
    name: string;
    creator?: User;
    change_logs?: ChangeLog[];
    readonly created_at?: Date;
}

export interface ProjectForm extends Omit<Project, "creator_id">, Form, FormMethod {
}

export interface Report {
    id: number;
    creator_id: number;
    date_from: Date;
    date_to: Date;
    creator?: User;
    products?: Product[];
    projects?: Project[];
    readonly created_at?: Date;
}

export interface ReportForm extends Omit<Report, "creator_id">, Form, FormMethod {
}

export interface ProductReport {
    product_id: number;
    report_id: number;
    quantity: number;
}

export interface ProjectReport {
    project_id: number;
    report_id: number;
}