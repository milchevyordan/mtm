import{d as x,C as T,D as I,i as k,m as j,g as c,b as s,r as y,j as N,z as E,a,w as n,y as B,o as l,n as h,c as w,u as f,k as b,Q as L,I as Z,F as D,l as z,t as m,h as C,e as d}from"./app-MO9c6B8p.js";import{A as Q}from"./ApplicationLogo-DNTm1rSG.js";const G={class:"relative"},H=x({__name:"Dropdown",props:{align:{default:"right"},width:{default:"48"},contentClasses:{default:"py-1 bg-white dark:bg-gray-700"}},setup(e){const o=e,t=g=>{i.value&&g.key==="Escape"&&(i.value=!1)};T(()=>document.addEventListener("keydown",t)),I(()=>document.removeEventListener("keydown",t));const r=k(()=>({48:"w-48"})[o.width.toString()]),u=k(()=>o.align==="left"?"ltr:origin-top-left rtl:origin-top-right start-0":o.align==="right"?"ltr:origin-top-right rtl:origin-top-left end-0":"origin-top"),i=j(!1);return(g,p)=>(l(),c("div",G,[s("div",{onClick:p[0]||(p[0]=_=>i.value=!i.value)},[y(g.$slots,"trigger")]),N(s("div",{class:"fixed inset-0 z-40",onClick:p[1]||(p[1]=_=>i.value=!1)},null,512),[[E,i.value]]),a(B,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"opacity-0 scale-95","enter-to-class":"opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"opacity-100 scale-100","leave-to-class":"opacity-0 scale-95"},{default:n(()=>[N(s("div",{class:h(["absolute z-50 mt-2 rounded-md shadow-lg",[r.value,u.value]]),style:{display:"none"},onClick:p[2]||(p[2]=_=>i.value=!1)},[s("div",{class:h(["rounded-md ring-1 ring-black ring-opacity-5",g.contentClasses])},[y(g.$slots,"content")],2)],2),[[E,i.value]])]),_:3})]))}}),F=x({__name:"DropdownLink",props:{href:{}},setup(e){return(o,t)=>(l(),w(f(b),{href:o.href,class:"block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800"},{default:n(()=>[y(o.$slots,"default")]),_:3},8,["href"]))}});var R=(e=>(e[e.Varna=1]="Varna",e[e.France=2]="France",e[e.Netherlands=3]="Netherlands",e))(R||{});function Fe(e){if(e!=null)return e instanceof Date?e.toLocaleDateString("de-DE",{day:"2-digit",month:"2-digit",year:"numeric"}):new Date(e).toLocaleDateString("de-DE",{day:"2-digit",month:"2-digit",year:"numeric"})}function Oe(e,o=!1){const t=[];for(const r in e)typeof e[r]=="number"&&t.push({name:o?J(r):r,value:e[r]});return t}function Ue(e){return typeof e=="string"?e.replace(/_/g," "):typeof e>"u"?"":Object.keys(e).map(t=>t.replace(/_/g," ")).join(" ")}function qe(e){const o={};for(let t in e){const r=t.replace(/_/g," ");o[r]=e[t]}return o}const Re=e=>{const o=encodeURIComponent(e);location.replace(route("files.download",o))},Ke=k(()=>new Date().toLocaleDateString("en-CA")),O=Object.entries(R).filter(([e])=>isNaN(Number(e))).map(([e,o])=>({name:e,value:o}));function Te(e){if(e===null)return;let o;if(e instanceof Date)o=e;else if(typeof e=="string"){if(e.includes("Z"))o=new Date(e);else{const t=new Date(e+"Z");o=new Date(t)}if(isNaN(o.getTime())){console.error("Invalid date string:",e);return}}else{console.error("Invalid input type:",typeof e);return}return o.toLocaleDateString("de-DE",{hour:"2-digit",minute:"2-digit",day:"2-digit",month:"2-digit",year:"numeric"})}function J(e){return e.charAt(0).toUpperCase()+e.slice(1)}function Ie(e){return e?[...e,"flash"]:[]}function Ze(e,o,t="?id"){return e.replace(t,o.toString())}function Qe(e,o){return e==null?void 0:Object.keys(e).find(r=>e[r]===o)||void 0}function Ge(e,o){if(o)return e[o]??void 0}function He(e,o=300){let t;return function(...r){t&&clearTimeout(t),t=setTimeout(()=>{e.apply(this,r)},o)}}function U(e){return!X(e)}function X(e){return Array.isArray(e)?e.length===0:!e||Object.keys(e).length===0}const Y={key:0,class:"'text-red-800 bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200 py-4 px-10 text-sm rounded-lg cursor-pointer text-center fixed top-6 left-1/2 transform -translate-x-1/2 z-[80]'"},W={key:1,class:"'text-red-800 bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200 py-4 px-10 text-sm rounded-lg cursor-pointer text-center fixed top-6 left-1/2 transform -translate-x-1/2 z-[80]'"},ee={key:2,class:"'text-green-800 bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200 py-4 px-10 text-sm rounded-lg cursor-pointer text-center fixed top-6 left-1/2 transform -translate-x-1/2 z-[80]'"},te=x({__name:"MessageAlert",setup(e){const o=L(),t=j(!1),r=()=>{L().props.flash=null},u=()=>{t.value=!1,r()};return Z(()=>{var i,g,p;(U((i=o.props.flash)==null?void 0:i.errors)||(g=o.props.flash)!=null&&g.error||(p=o.props.flash)!=null&&p.success)&&(t.value=!0,setTimeout(()=>{u()},1e3))}),(i,g)=>(l(),w(B,{name:"slide-fade"},{default:n(()=>{var p,_,M,S,A,P;return[t.value?(l(),c("div",{key:0,class:"fixed inset-0 z-50",role:"alert",onClick:u},[f(U)((p=f(o).props.flash)==null?void 0:p.errors)?(l(),c("div",Y,[(l(!0),c(D,null,z((_=f(o).props.flash)==null?void 0:_.errors,(V,K)=>(l(),c("div",{key:K},m(V[0]??V),1))),128))])):(M=f(o).props.flash)!=null&&M.error?(l(),c("div",W,m((S=f(o).props.flash)==null?void 0:S.error),1)):(A=f(o).props.flash)!=null&&A.success?(l(),c("div",ee,m((P=f(o).props.flash)==null?void 0:P.success),1)):C("",!0)])):C("",!0)]}),_:1}))}}),re={key:0,class:"relative"},oe={class:"absolute top-0 right-0 -mt-6 -mr-3 bg-red-500 text-white rounded-full px-2 text-xs"},$=x({__name:"NavLink",props:{href:{},active:{type:Boolean},notificationsCount:{}},setup(e){const o=e,t=k(()=>o.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out");return(r,u)=>(l(),w(f(b),{href:r.href,class:h(t.value)},{default:n(()=>[y(r.$slots,"default"),r.notificationsCount&&r.notificationsCount>0?(l(),c("div",re,[s("div",oe,m(r.notificationsCount),1)])):C("",!0)]),_:3},8,["href","class"]))}}),se={key:0,class:"relative"},ne={class:"absolute top-0 right-0 -mt-5 -mr-3 bg-red-500 text-white rounded-full px-2 text-xs"},v=x({__name:"ResponsiveNavLink",props:{href:{},active:{type:Boolean},notificationsCount:{}},setup(e){const o=e,t=k(()=>o.active?"w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 dark:border-indigo-600 text-start text-base font-medium text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/50 focus:outline-none focus:text-indigo-800 dark:focus:text-indigo-200 focus:bg-indigo-100 dark:focus:bg-indigo-900 focus:border-indigo-700 dark:focus:border-indigo-300 transition duration-150 ease-in-out":"w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-gray-700 focus:border-gray-300 dark:focus:border-gray-600 transition duration-150 ease-in-out");return(r,u)=>(l(),w(f(b),{href:r.href,class:h(t.value)},{default:n(()=>[y(r.$slots,"default"),r.notificationsCount&&r.notificationsCount>0?(l(),c("div",se,[s("div",ne,m(r.notificationsCount),1)])):C("",!0)]),_:3},8,["href","class"]))}}),ae={class:"w-[100px] whitespace-nowrap absolute -ml-6 mt-40 z-[1000] overflow-x-hidden bg-white dark:bg-gray-700 rounded shadow-xl"},q=x({__name:"Tooltip",props:{href:{},active:{type:Boolean}},setup(e){const o=e,t=j(!1),r=k(()=>o.active?"border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out");return(u,i)=>(l(),c("div",{class:h(["inline-flex items-center px-1 pt-1 border-b-2",r.value]),onMouseenter:i[0]||(i[0]=g=>t.value=!0),onMouseleave:i[1]||(i[1]=g=>t.value=!1)},[a(f(b),{href:u.href},{default:n(()=>[y(u.$slots,"default")]),_:3},8,["href"]),a(B,{"enter-active-class":"transition ease-out duration-100","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform opacity-0 scale-95"},{default:n(()=>[N(s("div",ae,[y(u.$slots,"content")],512),[[E,t.value]])]),_:3})],34))}}),ie={class:"min-h-screen bg-gray-100 dark:bg-gray-900"},de={class:"border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800"},le={class:"mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"},ue={class:"flex h-16 justify-between"},fe={class:"flex"},ce={class:"flex shrink-0 items-center"},pe={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},ge={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},he={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},me={class:"flex flex-col text-center font-semibold text-sm whitespace-normal"},ve={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},ye={class:"flex flex-col text-center font-semibold text-sm text-slate-800 whitespace-normal"},be={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},xe={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},ke={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},we={class:"hidden sm:ms-6 sm:flex sm:items-center"},_e={class:"relative ms-3"},$e={class:"inline-flex rounded-md"},Ce={type:"button",class:"inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"},De={class:"-me-2 flex items-center sm:hidden"},Le={class:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},je={class:"space-y-1 pb-3 pt-2"},Ne={class:"border-t border-gray-200 pb-1 pt-4 dark:border-gray-600"},Ee={class:"px-4"},ze={class:"text-base font-medium text-gray-800 dark:text-gray-200"},Be={class:"text-sm font-medium text-gray-500"},Me={class:"mt-3 space-y-1"},Se={key:0,class:"bg-white shadow dark:bg-gray-800"},Ae={class:"mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8"},Je=x({__name:"AuthenticatedLayout",setup(e){const o=j(!1);return(t,r)=>(l(),c(D,null,[a(te),s("div",null,[s("div",ie,[s("nav",de,[s("div",le,[s("div",ue,[s("div",fe,[s("div",ce,[a(f(b),{href:t.route("dashboard")},{default:n(()=>[a(Q,{class:"block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"})]),_:1},8,["href"])]),s("div",pe,[a($,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:n(()=>r[1]||(r[1]=[d(" Dashboard ")])),_:1},8,["href","active"])]),s("div",ge,[a($,{href:t.route("users.index"),active:t.route().current("users.*")},{default:n(()=>r[2]||(r[2]=[d(" User ")])),_:1},8,["href","active"])]),s("div",he,[a(q,{href:t.route("products.index"),active:t.route().current("products.*")},{content:n(()=>[s("div",me,[(l(!0),c(D,null,z(f(O),(u,i)=>(l(),w(f(b),{key:i,class:h(["text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 transition py-1",{"bg-gray-100 dark:bg-gray-800":t.route().current("products.table",u.name)}]),href:t.route("products.table",u.name)},{default:n(()=>[d(m(u.name),1)]),_:2},1032,["class","href"]))),128))])]),default:n(()=>[r[3]||(r[3]=d(" Product "))]),_:1},8,["href","active"])]),s("div",ve,[a(q,{href:t.route("projects.index"),active:t.route().current("projects.*")},{content:n(()=>[s("div",ye,[(l(!0),c(D,null,z(f(O),(u,i)=>(l(),w(f(b),{key:i,class:h(["text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 transition py-1",{"bg-gray-100 dark:bg-gray-800":t.route().current("projects.table",u.name)}]),href:t.route("projects.table",u.name)},{default:n(()=>[d(m(u.name),1)]),_:2},1032,["class","href"]))),128))])]),default:n(()=>[r[4]||(r[4]=d(" Project "))]),_:1},8,["href","active"])]),s("div",be,[a($,{href:t.route("product-requests.index"),active:t.route().current("product-requests.*")},{default:n(()=>r[5]||(r[5]=[d(" Request ")])),_:1},8,["href","active"])]),s("div",xe,[a($,{href:t.route("reports.index"),active:t.route().current("reports.*")},{default:n(()=>r[6]||(r[6]=[d(" Report ")])),_:1},8,["href","active"])]),s("div",ke,[a($,{href:t.route("notifications.index"),active:t.route().current("notifications.*"),"notifications-count":f(L)().props.auth.notificationsCount},{default:n(()=>r[7]||(r[7]=[d(" Notification ")])),_:1},8,["href","active","notifications-count"])])]),s("div",we,[s("div",_e,[a(H,{align:"right",width:"48"},{trigger:n(()=>[s("span",$e,[s("button",Ce,[d(m(t.$page.props.auth.user.name)+" ",1),r[8]||(r[8]=s("svg",{class:"-me-0.5 ms-2 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"},[s("path",{"fill-rule":"evenodd",d:"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z","clip-rule":"evenodd"})],-1))])])]),content:n(()=>[a(F,{href:t.route("profile.edit")},{default:n(()=>r[9]||(r[9]=[d(" Profile ")])),_:1},8,["href"]),a(F,{href:t.route("logout"),method:"post",as:"button"},{default:n(()=>r[10]||(r[10]=[d(" Log Out ")])),_:1},8,["href"])]),_:1})])]),s("div",De,[s("button",{class:"inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400",onClick:r[0]||(r[0]=u=>o.value=!o.value)},[(l(),c("svg",Le,[s("path",{class:h({hidden:o.value,"inline-flex":!o.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),s("path",{class:h({hidden:!o.value,"inline-flex":o.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])]),s("div",{class:h([{block:o.value,hidden:!o.value},"sm:hidden"])},[s("div",je,[a(v,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:n(()=>r[11]||(r[11]=[d(" Dashboard ")])),_:1},8,["href","active"]),a(v,{href:t.route("users.index"),active:t.route().current("users.*")},{default:n(()=>r[12]||(r[12]=[d(" User ")])),_:1},8,["href","active"]),a(v,{href:t.route("products.index"),active:t.route().current("products.*")},{default:n(()=>r[13]||(r[13]=[d(" Product ")])),_:1},8,["href","active"]),a(v,{href:t.route("projects.index"),active:t.route().current("projects.*")},{default:n(()=>r[14]||(r[14]=[d(" Project ")])),_:1},8,["href","active"]),a(v,{href:t.route("product-requests.index"),active:t.route().current("product-requests.*")},{default:n(()=>r[15]||(r[15]=[d(" Request ")])),_:1},8,["href","active"]),a(v,{href:t.route("reports.index"),active:t.route().current("reports.*")},{default:n(()=>r[16]||(r[16]=[d(" Report ")])),_:1},8,["href","active"]),a(v,{href:t.route("notifications.index"),active:t.route().current("notifications.*"),"notifications-count":f(L)().props.auth.notificationsCount},{default:n(()=>r[17]||(r[17]=[d(" Notification ")])),_:1},8,["href","active","notifications-count"])]),s("div",Ne,[s("div",Ee,[s("div",ze,m(t.$page.props.auth.user.name),1),s("div",Be,m(t.$page.props.auth.user.email),1)]),s("div",Me,[a(v,{href:t.route("profile.edit")},{default:n(()=>r[18]||(r[18]=[d(" Profile ")])),_:1},8,["href"]),a(v,{href:t.route("logout"),method:"post",as:"button"},{default:n(()=>r[19]||(r[19]=[d(" Log Out ")])),_:1},8,["href"])])])],2)]),t.$slots.header?(l(),c("header",Se,[s("div",Ae,[y(t.$slots,"header")])])):C("",!0),s("main",null,[y(t.$slots,"default")])])])],64))}});export{R as W,Je as _,Ie as a,Qe as b,Fe as c,Te as d,Re as e,Ge as f,Oe as g,qe as h,He as i,Ze as j,Ue as r,Ke as t,O as w};