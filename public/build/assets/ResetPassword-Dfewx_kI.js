import{d as f,T as c,c as w,w as n,o as _,a as e,u as o,Z as V,b as t,e as b,n as g,f as k}from"./app-Bvi4oo79.js";import{_ as l}from"./InputError.vue_vue_type_script_setup_true_lang-CVNr40G0.js";import{_ as m}from"./InputLabel.vue_vue_type_script_setup_true_lang-W2pR4QhM.js";import{P as v}from"./PrimaryButton-C07IvtWd.js";import{_ as i}from"./TextInput.vue_vue_type_script_setup_true_lang-_zxVFMTy.js";import{_ as P}from"./GuestLayout.vue_vue_type_script_setup_true_lang-CbMb9SrH.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ApplicationLogo-CQlkyxkR.js";const y={class:"mt-4"},x={class:"mt-4"},B={class:"mt-4 flex items-center justify-end"},E=f({__name:"ResetPassword",props:{email:{},token:{}},setup(p){const d=p,s=c({token:d.token,email:d.email,password:"",password_confirmation:""}),u=()=>{s.post(route("password.store"),{onFinish:()=>{s.reset("password","password_confirmation")}})};return(C,a)=>(_(),w(P,null,{default:n(()=>[e(o(V),{title:"Reset Password"}),t("form",{onSubmit:k(u,["prevent"])},[t("div",null,[e(m,{for:"email",value:"Email"}),e(i,{id:"email",modelValue:o(s).email,"onUpdate:modelValue":a[0]||(a[0]=r=>o(s).email=r),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),e(l,{class:"mt-2",message:o(s).errors.email},null,8,["message"])]),t("div",y,[e(m,{for:"password",value:"Password"}),e(i,{id:"password",modelValue:o(s).password,"onUpdate:modelValue":a[1]||(a[1]=r=>o(s).password=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue"]),e(l,{class:"mt-2",message:o(s).errors.password},null,8,["message"])]),t("div",x,[e(m,{for:"password_confirmation",value:"Confirm Password"}),e(i,{id:"password_confirmation",modelValue:o(s).password_confirmation,"onUpdate:modelValue":a[2]||(a[2]=r=>o(s).password_confirmation=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue"]),e(l,{class:"mt-2",message:o(s).errors.password_confirmation},null,8,["message"])]),t("div",B,[e(v,{class:g({"opacity-25":o(s).processing}),disabled:o(s).processing},{default:n(()=>a[3]||(a[3]=[b(" Reset Password ")])),_:1},8,["class","disabled"])])],32)]),_:1}))}});export{E as default};