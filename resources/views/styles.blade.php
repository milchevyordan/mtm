<style>
    @font-face {
        font-family: 'DejaVu Sans';
        src: url('font/DejaVuLGCSans.ttf') format('truetype');
    }

    body {
        font-family: 'DejaVu Sans', sans-serif;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
        padding: 0;
    }

    p {
        margin: 0;
        padding: 0;
    }

    table {
        border-collapse: collapse;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    @page {
        size: A4;
        margin-bottom: 50px !important;
        /* Makes padding for the pagination and logos  */
    }

    .car-box.border-top:nth-child(1) {
        border-top: none;
    }

    footer {
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
        /** Extra personal styles **/
        background-color: #03a9f4;
        color: white;
        text-align: center;
        line-height: 1.5cm;
    }

    footer {
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
        /** Extra personal styles **/
        background-color: #03a9f4;
        color: white;
        text-align: center;
        line-height: 1.5cm;
    }

    .car-box__images .image {
        width: 2.5cm;
        height: auto;
        border-radius: 0.375rem;
        /* Equivalent to rounded-md */
        object-fit: cover;
        /* Equivalent to object-cover */
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
        /* Equivalent to shadow */
    }

    .text-xs {
        font-size: 0.6em;
    }

    .text-s {
        font-size: 0.7em;
    }

    .text-normal {
        font-size: 1em;
    }

    .text-lg {
        font-size: 1.3em;
    }

    .text-xl {
        font-size: 1.5em;
    }

    .text-2xl {
        font-size: 3em;
    }

    .text-3xl {
        font-size: 4.5em;
    }

    .text-left {
        text-align: left;
    }


    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }


    .fw-lighter {
        font-weight: lighter;
    }

    .fw-semi-bold {
        font-weight: 600;
    }

    .fw-bold {
        font-weight: bold;
    }

    .italic {
        font-style: italic;
    }

    .float-left {
        float: left;
    }

    .float-right {
        float: right;
    }

    .w-full {
        width: 100%;
    }

    .width-half {
        width: 50%;
    }

    .width-third {
        width: 33.33%;
    }

    .width-two-thirds {
        width: 66.67%;
    }

    .width-quarter {
        width: 25%;
    }

    .width-twenty {
        width: 20%;
    }

    .width-fifteen {
        width: 15%;
    }

    .width-ten {
        width: 10%;
    }

    .border-bottom {
        border-bottom: 1px solid grey;
    }

    .border-top {
        border-top: 1px solid grey;
    }

    .border-bottom-white {
        border-bottom: 1px solid #ffffff;
        /* White border */
    }

    .m-4 {
        margin: 4em;
    }

    .mx-1 {
        margin: 0 1em;
    }

    .mx-2 {
        margin: 0 2em;
    }

    .mx-4 {
        margin: 0 4em;
    }

    .mt-0 {
        margin-top: 0;
    }

    .my-2 {
        margin: 2em 0;
    }

    .my-4 {
        margin: 2em 0;
    }

    .mt-half {
        margin-top: .5em;
    }
    .mt-1 {
        margin-top: 1em;
    }

    .mt-2 {
        margin-top: 2em;
    }

    .mt-3 {
        margin-top: 3em;
    }

    .mt-4 {
        margin-top: 4em;
    }

    .mb-half {
        margin-bottom: 0.5em;
    }

    .mb-1 {
        margin-bottom: 1em;
    }

    .mb-2 {
        margin-bottom: 2em;
    }

    .p-1 {
        padding: 1em;
    }

    .p-2 {
        padding: 2em;
    }

    .p-4 {
        padding: 4em;
    }

    .py-1 {
        padding: 1em 0;
    }

    .py-2 {
        padding: 2em 0;
    }

    .pt-half {
        padding-top: 0.5em;
    }

    .pt-1 {
        padding-top: 1em;
    }

    .pt-2 {
        padding-top: 2em;
    }

    .pt-3 {
        padding-top: 3em;
    }

    .pt-5 {
        padding-top: 5em;
    }

    .pb-1 {
        padding-bottom: 1em;
    }

    .p-half {
        padding: 0.5em;
    }

    .px-half {
        padding: 0 0.5em;
    }

    .py-half {
        padding: 0.5em 0;
    }

    .px-1 {
        padding: 0 1em;
    }

    .px-2 {
        padding: 0 2em;
    }

    .pl-1 {
        padding-left: 1em;
    }

    .pl-2 {
        padding-left: 2em;
    }

    .align-top {
        vertical-align: top;
    }

    .text-white {
        color: white;
    }

    .text-price {
        color: rgb(240, 123, 58);
    }

    .bg-gray {
        background-color: #d1d5db;
    }

    .rounded {
        border-radius: 0.375rem;
    }

    .page-break {
        page-break-after: always;
    }

    .break-inside-avoid {
        page-break-inside: avoid;
    }

    .break-inside-auto {
        break-inside: auto;
    }

    .container {
        padding: 0.5cm 1cm;
    }

    .shadow {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
    }
</style>