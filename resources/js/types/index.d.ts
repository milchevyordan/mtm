import {Warehouse} from "@/Enums/Warehouse";
import {ProductRequestStatus} from "@/Enums/ProductRequestStatus";

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
    warehouse: Enum<typeof Warehouse>;
    email_verified_at?: string;
    creator?: User;
    change_logs?: ChangeLog[];
    change_logs_limited?: ChangeLog[];
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
    change_logs_limited?: ChangeLog[];
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
    change_logs_limited?: ChangeLog[];
    readonly created_at?: Date;
}

export interface ProjectForm extends Omit<Project, "creator_id">, Form, FormMethod {
}

export interface Report {
    id: number;
    creator_id: number;
    date_from: Date;
    date_to: Date;
    pdf_path?: string;
    creator?: User;
    products?: Product[];
    projects?: Project[];
    readonly created_at?: Date;
}

export interface ReportForm extends Omit<Report, "creator_id">, Form, FormMethod {
}

export interface ProductRequest {
    id: number;
    creator_id: number;
    status: Enum<typeof ProductRequestStatus>;
    warehouse: Enum<typeof Warehouse>;
    creator?: User;
    products?: Product[];
    readonly created_at?: Date;
}

export interface ProductRequestForm extends Omit<ProductRequest, "creator_id", "status">, Form, FormMethod {
    products: any;
}

export interface ProductProductRequest {
    id: number;
    product_request_id: number;
    product_id: number;
    quantity: number;
    actual_quantity: number;
    readonly created_at?: Date;
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