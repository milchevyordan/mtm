import{d as C,o,g as n,b as s,n as $,T as Z,m as x,u as h,a as w,j as E,G as z,h as k,q as S,e as R,t as P,H as A,F as B,l as M,c as L,w as T,k as N,A as j,B as G,r as V}from"./app-DNzCrRZN.js";import{_ as H}from"./Select.vue_vue_type_script_setup_true_lang-CijPz9Ej.js";import{P as W}from"./ProductType-DHxMMxY3.js";import{i as D,j as q}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-JRAjt2nF.js";import{_ as I}from"./_plugin-vue_export-helper-DlAUqK2U.js";const Y=["stroke-width"],J=C({__name:"Magnifying",props:{classes:{default:"w-6 h-6 flex-shrink-0"},stroke:{default:"1.5"}},setup(i){return(a,l)=>(o(),n("svg",{fill:"none",viewBox:"0 0 24 24","stroke-width":a.stroke,stroke:"currentColor",class:$(a.classes)},l[0]||(l[0]=[s("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"},null,-1)]),10,Y))}}),K={class:"md:flex items-center justify-between space-y-2 sm:space-y-0 gap-2"},Q={class:"md:w-80 lg:w-96 relative"},X={class:"relative"},ee={key:0,class:"md:w-60 lg:w-72 relative"},re=C({__name:"GlobalSearch",props:{propName:{},typeSearch:{type:Boolean}},setup(i){const a=i,l=new URLSearchParams(window.location.search).get("filter[global]"),p=new URLSearchParams(window.location.search).get("filter[type]"),u=Z({filter:{global:l,type:p,timeZone:Intl.DateTimeFormat().resolvedOptions().timeZone}}),r=x(u.filter.global),e=x(u.filter.type),d=D(()=>{const c=route(),v={...c.params,page:1};u.filter.global=r.value,u.filter.type=e.value,S.visit(route(c.current(),v),{method:"get",data:{filter:{global:u.filter.global,type:u.filter.type,timeZone:u.filter.timeZone}},preserveState:!0,preserveScroll:!0,only:[a.propName]})},1200);return(c,v)=>(o(),n("div",K,[s("div",Q,[s("div",{class:"absolute inset-y-0 left-0 flex items-center pl-3 z-10 cursor-pointer",onClick:v[0]||(v[0]=(..._)=>h(d)&&h(d)(..._))},[w(J,{stroke:"2",classes:"w-5 h-5 text-gray-400 dark:text-gray-300"})]),s("div",X,[E(s("input",{"onUpdate:modelValue":v[1]||(v[1]=_=>r.value=_),class:"border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-300 pl-10 pr-4 text-sm rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 block w-full p-2.5 placeholder-gray-400 dark:placeholder-gray-500 peer transition hover:bg-gray-50 dark:hover:bg-gray-800 focus:bg-gray-50 dark:focus:bg-gray-900 z-0",placeholder:"Търсене...",onInput:v[2]||(v[2]=(..._)=>h(d)&&h(d)(..._))},null,544),[[z,r.value]])])]),c.typeSearch?(o(),n("div",ee,[w(H,{modelValue:e.value,"onUpdate:modelValue":v[3]||(v[3]=_=>e.value=_),name:"type",options:h(W),placeholder:"Тип",class:"block w-full",onSelect:h(d),onRemove:h(d)},null,8,["modelValue","options","onSelect","onRemove"])])):k("",!0)]))}}),te=["stroke-width"],ae=C({__name:"ChevronDoubleLeft",props:{classes:{default:"mr-[1px] w-5 h-5 flex-shrink-0"},stroke:{default:"2"}},setup(i){return(a,l)=>(o(),n("svg",{fill:"none",viewBox:"0 0 24 24","stroke-width":a.stroke,stroke:"currentColor",class:$(a.classes)},l[0]||(l[0]=[s("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5"},null,-1)]),10,te))}}),oe=["stroke-width"],se=C({__name:"ChevronLeft",props:{classes:{default:"mr-[1px] w-5 h-5 flex-shrink-0"},stroke:{default:"2"}},setup(i){return(a,l)=>(o(),n("svg",{fill:"none",viewBox:"0 0 24 24","stroke-width":a.stroke,stroke:"currentColor",class:$(a.classes)},l[0]||(l[0]=[s("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M15.75 19.5L8.25 12l7.5-7.5"},null,-1)]),10,oe))}}),ne=["stroke-width"],le=C({__name:"ChevronRight",props:{classes:{default:"ml-[1px] w-5 h-5 flex-shrink-0"},stroke:{default:"2"}},setup(i){return(a,l)=>(o(),n("svg",{fill:"none",viewBox:"0 0 24 24","stroke-width":a.stroke,stroke:"currentColor",class:$(a.classes)},l[0]||(l[0]=[s("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M8.25 4.5l7.5 7.5-7.5 7.5"},null,-1)]),10,ne))}}),ie={key:0,class:"flex justify-center sm:justify-between my-2 px-5 items-center"},de={class:"hidden sm:block text-sm text-gray-500 dark:text-gray-300"},ge={class:"font-semibold"},ue={class:"font-semibold"},pe={class:"font-semibold"},ce={key:0,class:"flex gap-x-2"},he=["value"],be={class:"flex gap-x-2"},me={key:2,class:"flex items-center gap-2 ml-2"},ke=C({__name:"Pagination",props:{paginator:{},propName:{default:"dataTable"},perPageOptions:{}},setup(i){const a=i,l=x(null),p=(r,e)=>{const d=new URL(window.location.href),c=d.searchParams;return c.delete(r),c.set(r,String(e)),d.toString()},u=async()=>{await new Promise((r,e)=>{S.reload({data:{perPage:l.value},only:[a.propName],onSuccess:r,onError:e})})};return(r,e)=>Object.keys(r.paginator.links).length>1?(o(),n("div",ie,[s("div",de,[e[1]||(e[1]=R(" Showing ")),s("span",ge,P(r.paginator.currentPage*r.paginator.perPage-(r.paginator.perPage-1)),1),e[2]||(e[2]=R(" to ")),s("span",ue,P(r.paginator.currentPage==r.paginator.lastPage?r.paginator.itemsLength:r.paginator.currentPage*r.paginator.perPage),1),e[3]||(e[3]=R(" of ")),s("span",pe,P(r.paginator.itemsLength),1),e[4]||(e[4]=R(" Entries "))]),r.perPageOptions?(o(),n("div",ce,[E(s("select",{"onUpdate:modelValue":e[0]||(e[0]=d=>l.value=d),class:"rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600",onChange:u},[e[5]||(e[5]=s("option",{value:null}," Default ",-1)),(o(!0),n(B,null,M(r.perPageOptions,d=>(o(),n("option",{value:d},P(d),9,he))),256))],544),[[A,l.value]])])):k("",!0),s("div",be,[r.paginator.currentPage-r.paginator.pagesRange>1?(o(),L(h(N),{key:0,class:"element-center rounded w-9 h-9 leading-4 text-sm transition text-gray-500 hover:text-white bg-white dark:bg-gray-900 dark:text-gray-300 hover:bg-indigo-400 dark:hover:bg-indigo-600",only:[r.propName,"paginator"],"preserve-state":!0,href:p("page",1),"preserve-scroll":""},{default:T(()=>[w(ae)]),_:1},8,["only","href"])):k("",!0),r.paginator.currentPage!==1?(o(),L(h(N),{key:1,class:"element-center rounded w-9 h-9 leading-4 text-sm transition text-gray-500 hover:text-white bg-white dark:bg-gray-900 dark:text-gray-300 hover:bg-indigo-400 dark:hover:bg-indigo-600",href:p("page",r.paginator.currentPage-1)},{default:T(()=>[w(se)]),_:1},8,["href"])):k("",!0),(o(!0),n(B,null,M(r.paginator.links,(d,c)=>(o(),n("div",null,[w(h(N),{class:$(["element-center rounded w-9 h-9 leading-4 text-sm transition",c==r.paginator.currentPage?"bg-indigo-400 dark:bg-indigo-600 text-white":"text-gray-500 dark:text-gray-300 hover:text-white bg-white dark:bg-gray-900 hover:bg-indigo-400 dark:hover:bg-indigo-600"]),only:[r.propName,"paginator"],"preserve-scroll":"","preserve-state":!0,href:d},{default:T(()=>[R(P(c),1)]),_:2},1032,["only","href","class"])]))),256)),r.paginator.currentPage+r.paginator.pagesRange<r.paginator.lastPage?(o(),n("div",me,[e[6]||(e[6]=s("div",{class:"text-xl tracking-widest mt-2 dark:text-gray-300"}," ... ",-1)),w(h(N),{class:"element-center rounded w-9 h-9 leading-4 text-sm transition text-gray-500 hover:text-white bg-white dark:bg-gray-900 dark:text-gray-300 hover:bg-indigo-400 dark:hover:bg-indigo-600",only:[r.propName],"preserve-scroll":"","preserve-state":!0,href:r.paginator.lastPageUrl},{default:T(()=>[R(P(r.paginator.lastPage),1)]),_:1},8,["only","href"])])):k("",!0),r.paginator.currentPage<r.paginator.lastPage?(o(),L(h(N),{key:3,class:"element-center rounded w-9 h-9 leading-4 text-sm transition text-gray-500 hover:text-white bg-white dark:bg-gray-900 dark:text-gray-300 hover:bg-indigo-400 dark:hover:bg-indigo-600",only:[r.propName],"preserve-scroll":"","preserve-state":!0,href:p("page",r.paginator.currentPage+1)},{default:T(()=>[w(le)]),_:1},8,["only","href"])):k("",!0)])])):k("",!0)}}),fe=["id","value","name","checked"],ye=["for"],O=C({__name:"RadioButton",props:{name:{},id:{},value:{},label:{},classes:{default:"peer-checked:bg-slate-500 peer-checked:text-white peer-checked:border-blue-200 border"},checked:{type:Boolean},disabled:{type:Boolean}},emits:["click"],setup(i,{emit:a}){const l=i,p=a,u=()=>{l.disabled||p("click")},r=`bg-slate-300 cursor-default dark:bg-gray-800 dark:text-gray-400 ${l.checked?"bg-slate-500 text-white dark:bg-gray-700 dark:text-white":""}`;return(e,d)=>(o(),n(B,null,[s("input",{id:e.id,type:"radio",value:e.value,name:e.name,class:"peer hidden",checked:e.checked},null,8,fe),s("label",{for:e.id,class:$(`${e.disabled?r:e.classes}
        ${e.disabled?"cursor-default":"cursor-pointer transition-all active:scale-95"}
        relative flex shadow-md text-slate-500 border border-blue-200 px-4 py-1.5 dark:text-gray-300 dark:border-gray-700 dark:bg-gray-900`),onClick:u},P(e.label),11,ye)],64))}}),ve=C({__name:"RadioButtonToggle",props:j({name:{},classes:{default:"flex sm:justify-end mb-3.5 sm:mb-0"},disabled:{type:Boolean},leftButtonLabel:{default:"Yes"},rightButtonLabel:{default:"No"}},{modelValue:{type:Boolean,default:!1},modelModifiers:{}}),emits:j(["change"],["update:modelValue"]),setup(i,{emit:a}){const l=a,p=i,u=G(i,"modelValue"),r=e=>{u.value=e,l("change",{name:p.name,value:e})};return(e,d)=>(o(),n("div",null,[s("div",{class:$(e.classes)},[s("div",null,[w(O,{id:"yes_"+e.name,label:e.leftButtonLabel,name:e.name,disabled:e.disabled,classes:`peer-checked:bg-indigo-500 peer-checked:text-white peer-checked:border-indigo-200
                         border border-r-0 rounded-l-md bg-white dark:bg-gray-900
                         dark:border-gray-700 dark:peer-checked:bg-indigo-600
                         dark:peer-checked:border-indigo-600`,checked:u.value==!0,onClick:d[0]||(d[0]=c=>r(!0))},null,8,["id","label","name","disabled","checked"])]),s("div",null,[w(O,{id:"no_"+e.name,label:e.rightButtonLabel,name:e.name,disabled:e.disabled,classes:`peer-checked:bg-indigo-500 peer-checked:text-white peer-checked:border-indigo-200
                         border border-l-0 rounded-r-md bg-white dark:bg-gray-900
                         dark:border-gray-700 dark:peer-checked:bg-indigo-600
                         dark:peer-checked:border-indigo-600`,checked:u.value==!1,onClick:d[1]||(d[1]=c=>r(!1))},null,8,["id","label","name","disabled","checked"])])],2)]))}}),we=C({__name:"TrashedRecords",props:{propName:{}},setup(i){var r;const a=i,l=route(),p=x(((r=l.params.filter)==null?void 0:r.trashed)=="true"),u=async e=>{await new Promise((d,c)=>{S.reload({data:{filter:{trashed:e.value}},only:[a.propName],onSuccess:d,onError:c})})};return(e,d)=>(o(),L(ve,{key:"filter[trashed]",modelValue:p.value,"onUpdate:modelValue":d[0]||(d[0]=c=>p.value=c),name:"filter[trashed]","left-button-label":"Бракуван","right-button-label":"В експлоатация",onChange:u},null,8,["modelValue"]))}}),$e={},Ce={width:"8",height:"6",viewBox:"0 0 9 7",fill:"none"};function Pe(i,a){return o(),n("svg",Ce,a[0]||(a[0]=[s("path",{d:"M8.46854 0.938232H0.53146C0.293396 0.938232 0.160467 1.18959 0.307898 1.36119L4.27644 5.96295C4.39003 6.09468 4.60876 6.09468 4.72356 5.96295L8.6921 1.36119C8.83953 1.18959 8.7066 0.938232 8.46854 0.938232Z",fill:"#BDBCBC"},null,-1)]))}const _e=I($e,[["render",Pe]]),Se={},Be={width:"8",height:"6",viewBox:"0 0 9 7",fill:"none"};function Le(i,a){return o(),n("svg",Be,a[0]||(a[0]=[s("path",{d:"M8.6921 5.63879L4.72356 1.03702C4.60997 0.905302 4.39124 0.905302 4.27644 1.03702L0.307898 5.63879C0.160467 5.81039 0.293396 6.06174 0.53146 6.06174H8.46854C8.7066 6.06174 8.83953 5.81039 8.6921 5.63879Z",fill:"#BDBCBC"},null,-1)]))}const Re=I(Se,[["render",Le]]);function U(i){return Array.isArray(i)?i.join("."):i}const Te=(i,a)=>typeof i!="string"?i:i.length>a?i.substring(0,a)+"...":i,Ne=C({__name:"Restore",props:{classes:{default:"w-6 h-6 flex-shrink-0"},solid:{}},setup(i){return(a,l)=>a.solid?(o(),n("svg",{key:0,viewBox:"0 0 25 25",fill:"currentColor",class:$(a.classes)},l[0]||(l[0]=[s("path",{d:"M5.88468 17C7.32466 19.1128 9.75033 20.5 12.5 20.5C16.9183 20.5 20.5 16.9183 20.5 12.5C20.5 8.08172 16.9183 4.5 12.5 4.5C8.08172 4.5 4.5 8.08172 4.5 12.5V13.5M12.5 8V12.5L15.5 15.5"},null,-1),s("path",{d:"M7 11L4.5 13.5L2 11"},null,-1)]),2)):(o(),n("svg",{key:1,fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:$(a.classes)},l[1]||(l[1]=[s("path",{d:"M5.88468 17C7.32466 19.1128 9.75033 20.5 12.5 20.5C16.9183 20.5 20.5 16.9183 20.5 12.5C20.5 8.08172 16.9183 4.5 12.5 4.5C8.08172 4.5 4.5 8.08172 4.5 12.5V13.5M12.5 8V12.5L15.5 15.5"},null,-1),s("path",{d:"M7 11L4.5 13.5L2 11"},null,-1)]),2))}}),Ve={key:0,class:"bg-white dark:bg-gray-800 border border-[#E9E7E7] dark:border-gray-700 rounded-lg p-4 mb-4 sm:flex items-center justify-between shadow space-y-2 sm:space-y-0"},Me={key:2,class:"sm:flex items-center gap-2"},xe={class:"table-container max-w-full overflow-x-auto"},Fe={class:"w-full text-sm text-left text-gray-500 dark:text-gray-400"},je={class:"text-xs uppercase text-black dark:text-gray-200 bg-[#F0F0F0] dark:bg-gray-700"},Oe=["onClick"],Ue={class:"w-full flex items-center gap-1.5"},Ee={key:0},Ie=["onClick"],Ze={class:"whitespace-nowrap px-6 py-3.5"},ze={key:0},Ae={key:1},Ge={key:2},He={key:3},We={key:4},De=["onClick"],qe={key:5},Ye={key:1},Je=["colspan"],Ke=["colspan"],or=C({__name:"Table",props:{dataTable:{},propName:{default:"dataTable"},globalSearch:{type:Boolean},typeSearch:{type:Boolean},showTrashed:{type:Boolean},advancedFilters:{type:Boolean},selectedRowIndexes:{},selectedRowColumn:{},rowClickLink:{},perPageOptions:{}},setup(i){const a=i,l=route(),p=()=>{var t,b;return!!((b=(t=l.params)==null?void 0:t.filter)!=null&&b.trashed)&&l.params.filter.trashed==="true"};let u=null,r=null;const e=a.rowClickLink?a.rowClickLink.includes("?id"):!1,d=(t,b,g)=>{const m=t[b];return m?m!==void 0&&m[g]!==void 0?m[g]===""?"":m[g]:"Undefined relation":""},c=(t,b)=>{typeof a.rowClickLink<"u"&&!p()&&e&&["DIV","TD"].includes(t.target.tagName)&&S.get(q(a.rowClickLink,b))},v=async(t,b)=>{var m,f;if(!t)return;let g=((f=(m=l.params)==null?void 0:m.ordering)==null?void 0:f.direction)||"desc";b===u&&(g=r==="asc"?"desc":"asc"),await new Promise((y,F)=>{S.reload({data:{ordering:{key:b,direction:g}},only:[a.propName],onSuccess:y,onError:F})}),u=b,r=g},_=async t=>{await new Promise((g,m)=>{S.reload({data:{restore_id:t},only:[a.propName],onSuccess:g,onError:m})});const b=new URL(window.location.href);b.searchParams.delete("restore_id"),S.get(b.toString())};return(t,b)=>(o(),n(B,null,[t.globalSearch||t.typeSearch||t.$slots.advancedFilters||t.$slots.additionalContent?(o(),n("div",Ve,[t.globalSearch||t.typeSearch?(o(),L(re,{key:0,"type-search":t.typeSearch,"prop-name":t.propName},null,8,["type-search","prop-name"])):k("",!0),t.showTrashed?(o(),L(we,{key:1,"prop-name":t.propName},null,8,["prop-name"])):k("",!0),t.$slots.advancedFilters||t.$slots.additionalContent?(o(),n("div",Me,[V(t.$slots,"advancedFilters"),V(t.$slots,"additionalContent")])):k("",!0)])):k("",!0),s("div",xe,[s("table",Fe,[s("thead",je,[s("tr",null,[(o(!0),n(B,null,M(t.dataTable.columns,(g,m)=>(o(),n("th",{scope:"col",class:$(["px-6 py-3 border-r dark:border-gray-600",g.orderable?"cursor-pointer":"cursor-default"]),onClick:f=>v(g.orderable,String(m))},[s("div",Ue,[s("span",null,P(g.label),1),g.orderable?(o(),n("span",Ee,[w(Re),w(_e)])):k("",!0)])],10,Oe))),256))])]),s("tbody",null,[t.dataTable.data.length>0?(o(!0),n(B,{key:0},M(t.dataTable.data,(g,m)=>(o(),n("tr",{class:$([m!==t.dataTable.data.length-1?"border-b dark:border-gray-600":"",t.selectedRowIndexes&&t.selectedRowColumn&&(t.selectedRowIndexes.includes(Number(g[t.selectedRowColumn]))||t.selectedRowIndexes.includes(g[t.selectedRowColumn]))?"bg-indigo-400 dark:bg-indigo-600 text-white":"bg-white dark:bg-gray-800",{"cursor-pointer":h(e)&&!p()}]),onClick:f=>c(f,g.id)},[(o(!0),n(B,null,M(t.dataTable.columns,(f,y,F)=>(o(),n("td",Ze,[f.relation&&t.$slots[`cell(${h(U)(f.relationWithColumn)})`]?(o(),n("div",ze,[V(t.$slots,`cell(${h(U)(f.relationWithColumn)})`,{value:g[f.relation],item:g})])):f.relation&&!t.$slots[`cell(${String(y)})`]?(o(),n("div",Ae,P(d(g,f.relation.relationTable,f.relation.relationColumn)),1)):k("",!0),t.$slots[`cell(${String(y)})`]&&!p()?(o(),n("div",Ge,[V(t.$slots,`cell(${String(y)})`,{value:g[y],item:g})])):t.$slots[`cell(${String(y)})`]&&p()&&y!=="action"?(o(),n("div",He,[V(t.$slots,`cell(${String(y)})`,{value:g[y],item:g})])):t.$slots[`cell(${String(y)})`]&&p()&&y==="action"?(o(),n("div",We,[s("button",{class:"border border-[#E9E7E7] rounded-md p-1 active:scale-90 transition bg-blue-100 text-blue-500 duration-300 ease-in-out hover:bg-blue-200 dark:border-gray-700 dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800",title:"Restore",onClick:Qe=>_(g.id)},[w(Ne,{classes:"w-4 h-4"})],8,De)])):(o(),n("div",qe,P(h(Te)(g[y],35)),1))]))),256))],10,Ie))),256)):(o(),n("tr",Ye,[s("td",{class:"bg-white dark:bg-gray-800 text-center py-5 text-lg font-semibold text-gray-900 dark:text-gray-100",colspan:Object.keys(a.dataTable.columns).length}," No found data ",8,Je)]))]),s("tfoot",null,[s("td",{class:"bg-[#F0F0F0] dark:bg-gray-700",colspan:Object.keys(a.dataTable.columns).length},[t.dataTable.data.length>1||t.dataTable.paginator.currentPage>1?(o(),L(ke,{key:0,paginator:t.dataTable.paginator,"prop-name":t.propName,"per-page-options":t.perPageOptions},null,8,["paginator","prop-name","per-page-options"])):k("",!0)],8,Ke)])])])],64))}});export{or as _};