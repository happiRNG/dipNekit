<script src="https://lidrekon.ru/slep/js/jquery.js"></script>
<script src="https://lidrekon.ru/slep/js/uhpv-full.min.js"></script>
<script src="/templates/LeftMenu/cssworld.ru-xcal-en.js"></script>
<link rel="stylesheet" type="text/css" href="/templates/LeftMenu/cssworld.ru-xcal.css" />

<script lang="javascript" src="js-xlsx/dist/xlsx.core.min.js"></script>
<script src="js-xlsx/dist/cpexcel.js"></script>
<script src="js-xlsx/dist/ods.js"></script>

<script>
   

    const clickOnDate = (date) => {
        var select = document.getElementById('group_id')

        select.addEventListener('change', (e) => {
            selectedGroup(e.target.value)
        })

        schedule.forEach((group, ind) => {
            var option = document.createElement('option')

            option.textContent = group.name
            option.value = ind

            select.appendChild(option)
        })
        
    }

    const selectedGroup = (index) => {
        var block = document.getElementById('schedule_block')
        block.innerHTML =''
        // console.log(index); 
        schedule[index].lesson.forEach((les) => {
            var p1 = document.createElement('p')
            var p2 = document.createElement('p')
            var p3 = document.createElement('p')

            p1.textContent = les.name
            p2.textContent = les.teacher
            p3.textContent = les.room

            block.append(p1)
            block.append(p2)
            block.append(p3)
        })
    }

        /* set up XMLHttpRequest */
        var url = "/templates/LeftMenu/rasp/Rasp.-na-.23.03.2022..xlsx";
        var oReq = new XMLHttpRequest();

        oReq.open("GET", url, true);
        oReq.responseType = "arraybuffer";

        var schedule = [
                // 
                // пример заполнения данными
                // 
                // { 
                //     name: '21КСК-1',
                //     lesson: [
                //         {
                //             name: 'Математика',
                //             teacher: 'Ходырева И.С.',
                //             room: '1116',
                //         }
                //     ]
                // }
            ]

        oReq.onload = function(e) {
            var arraybuffer = oReq.response;

            /* convert data to binary string */
            var data = new Uint8Array(arraybuffer);
            var arr = new Array();
            for(var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
            var bstr = arr.join("");

            /* Call XLSX */
            var workbook = XLSX.read(bstr, {type:"binary"});

            var sheet_name_list = workbook.SheetNames[0];

            var worksheet = workbook.Sheets[sheet_name_list];

            var i = 0;//индекс строки в массиве
            var k = 0;//индекс столбца в массиве
            var everyFourIndex = 1; //для отслеживания каждого четвертого столбца
            var saveRow = 2;//метка для определения новой строки

            for (z in worksheet) {
                if(z[0] === '!') continue;

                const newRow = parseInt(z.match(/\d+/))//получаем номер строки в exel

                if (newRow != saveRow) { //если новая строка сбрасываем счетчик столбцов
                    // console.log('newRow', newRow);
                    // console.log('saveRow', saveRow);
                    // console.log('i', i);
                    k = 0
                    i++
                    saveRow = newRow
                    everyFourIndex = 1
                }

                if(k%4 != 0 && i == 0) { //пропускаем все кроме каждого 4 столбца 0 строки
                    k++; 
                    continue;
                }
                
                //следующий код выполняется для каждого 4 столбца n строки
                if(i == 0) {//если 0 строка добовляем в массив 
                    schedule.push({
                        name: worksheet[z].v,
                        lesson: []
                    })
                }
                else{
                    
                    if(k%4 == 0) {//для выполняния действий с каждым 4 столбцом
                        if(!schedule[k/4]) continue
                        
                        if (i%2 != 0){//для чередования действий по строкам
                            
                            let ind = Math.floor(i/2)
                            let col = Math.floor(k/4)
                            
                            if (typeof schedule[col].lesson[ind] != 'object') schedule[col].lesson[ind] = {}
                            schedule[col].lesson[ind].name = worksheet[z].v
                        } else {                           
                            let col = Math.floor(k/4)
                            let ind = i/2-1

                            schedule[col].lesson[ind].teacher = worksheet[z].v
                        }
                    }

                    if(everyFourIndex >= 4) { //для выполняния действий с каждым 3 столбцом
                        if (i%2 != 0){
                            let ind = Math.floor(i/2)
                            let col = Math.floor(k/4)

                            schedule[col].lesson[ind].room = worksheet[z].v
                        }
                        everyFourIndex = 0
                    }
                }
                
                k++
                everyFourIndex++
            }
        }

        oReq.send();

</script>


<div class="left_menu_wrapper">
    <div class="top_button">
        <img id="specialButton" src="/sources/left_menu/back_view.png" alt="ВЕРСИЯ ДЛЯ СЛАБОВИДЯЩИХ" title="ВЕРСИЯ ДЛЯ СЛАБОВИДЯЩИХ">
    </div>


    <div id="calendar_block" class="calendar">
        <div id="date8"></div>
        <style>#cssworldru8{position: static}</style>
        <script>
            xCal("date8", {
            id: "cssworldru8", // Задать уникальный ID
            "class": "xcalend", // CSS класс оформления внешнего вида
            hide: 0, // Не скрывать календарь
            x: 0, // Отключить кнопку закрытия календаря
            autoOff: 0, // Отключить автоматическое скрытие
            to: "date8", // Разместить календарь внутри элемента с id=date8
            fn: "alert" // Вызвать функцию с указанным названием, в нее будет передан результат выбора
            });
        </script>

        Расписание для:<br>
        <select id="group_id">
            <option value="-1" >Выберите группу</option>
        </select>

        <div id="schedule_block"></div>
    </div>

  



    <div class="otst">
    <div class="image_block">
        <a href="http://gaoyspooomk.narod.ru/covid.html"><img src="/sources/left_menu/covid.png" alt="image"></a>
        <a href="https://docs.google.com/forms/d/e/1FAIpQLSeCar2FqWT0p8l0ZB824JqYXfI76bP2Z3CJwapPJkledj0lqA/viewform"><img src="/sources/left_menu/Assessment_questionnaire.png" alt="image"></a>
        <a href="https://minzdrav.gov.ru/"><img src="/sources/left_menu/minzdrav.png" alt="image"></a>
        <a href="http://gaoyspooomk.narod.ru/obrscor.html"><img src="/sources/left_menu/corruption.png" alt="image"></a>
      
    </div>
    </div>


    <script src='https://pos.gosuslugi.ru/bin/script.min.js'></script> 
  
    <div class="otst">
<style>
#js-show-iframe-wrapper{position:relative;display:flex;align-items:center;justify-content:center;min-height:256px;width:100%;min-width:293px;max-width:100%;background:linear-gradient(138.4deg,#38bafe 26.49%,#2d73bc 79.45%);color:#fff;cursor:pointer}#js-show-iframe-wrapper .pos-banner-fluid *{box-sizing:border-box}#js-show-iframe-wrapper .pos-banner-fluid .pos-banner-btn_2{display:block;width:240px;min-height:56px;font-size:18px;line-height:24px;cursor:pointer;background:#0d4cd3;color:#fff;border:none;border-radius:8px;outline:0}#js-show-iframe-wrapper .pos-banner-fluid .pos-banner-btn_2:hover{background:#1d5deb}#js-show-iframe-wrapper .pos-banner-fluid .pos-banner-btn_2:focus{background:#2a63ad}#js-show-iframe-wrapper .pos-banner-fluid .pos-banner-btn_2:active{background:#2a63ad}@-webkit-keyframes fadeInFromNone{0%{display:none;opacity:0}1%{display:block;opacity:0}100%{display:block;opacity:1}}@keyframes fadeInFromNone{0%{display:none;opacity:0}1%{display:block;opacity:0}100%{display:block;opacity:1}}@font-face{font-family:LatoWebLight;src:url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Light.woff2) format("woff2"),url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Light.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Light.ttf) format("truetype");font-style:normal;font-weight:400}@font-face{font-family:LatoWeb;src:url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Regular.woff2) format("woff2"),url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Regular.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Regular.ttf) format("truetype");font-style:normal;font-weight:400}@font-face{font-family:LatoWebBold;src:url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Bold.woff2) format("woff2"),url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Bold.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Bold.ttf) format("truetype");font-style:normal;font-weight:400}
</style>

<style>
#js-show-iframe-wrapper .bf-2{position:relative;display:grid;grid-template-columns:var(--pos-banner-fluid-2__grid-template-columns);grid-template-rows:var(--pos-banner-fluid-2__grid-template-rows);width:100%;max-width:1060px;font-family:LatoWeb,sans-serif;box-sizing:border-box}#js-show-iframe-wrapper .bf-2__decor{grid-column:var(--pos-banner-fluid-2__decor-grid-column);grid-row:var(--pos-banner-fluid-2__decor-grid-row);padding:var(--pos-banner-fluid-2__decor-padding);background:var(--pos-banner-fluid-2__bg-url) var(--pos-banner-fluid-2__bg-position) no-repeat;background-size:var(--pos-banner-fluid-2__bg-size)}#js-show-iframe-wrapper .bf-2__logo-wrap{position:absolute;top:var(--pos-banner-fluid-2__logo-wrap-top);bottom:var(--pos-banner-fluid-2__logo-wrap-bottom);right:0;display:flex;flex-direction:column;align-items:flex-end;padding:var(--pos-banner-fluid-2__logo-wrap-padding);background:#2d73bc;border-radius:var(--pos-banner-fluid-2__logo-wrap-border-radius)}#js-show-iframe-wrapper .bf-2__logo{width:128px}#js-show-iframe-wrapper .bf-2__slogan{font-family:LatoWebBold,sans-serif;font-size:var(--pos-banner-fluid-2__slogan-font-size);line-height:var(--pos-banner-fluid-2__slogan-line-height);color:#fff}#js-show-iframe-wrapper .bf-2__content{padding:var(--pos-banner-fluid-2__content-padding)}#js-show-iframe-wrapper .bf-2__description{display:flex;flex-direction:column;margin-bottom:24px}#js-show-iframe-wrapper .bf-2__text{margin-bottom:12px;font-size:24px;line-height:32px;font-family:LatoWebBold,sans-serif;color:#fff}#js-show-iframe-wrapper .bf-2__text_small{margin-bottom:0;font-size:16px;line-height:24px;font-family:LatoWeb,sans-serif}#js-show-iframe-wrapper .bf-2__btn-wrap{display:flex;align-items:center;justify-content:center}
</style >
<div id='js-show-iframe-wrapper'>
  <div class='pos-banner-fluid bf-2' margin-bottom:20px;>

    <div class='bf-2__decor'>
      <div class='bf-2__logo-wrap'>
        <img
         class='bf-2__logo'
          src='https://pos.gosuslugi.ru/bin/banner-fluid/gosuslugi-logo.svg'
          alt='Госуслуги'
          
                  />
        <div class='bf-2__slogan'>Решаем вместе</div >
      </div >
    </div >
    <div class='bf-2__content'>

      <div class='bf-2__description'>
          <span class='bf-2__text'>
            Не убран мусор, яма на дороге, не горит фонарь?
          </span >
        <span class='bf-2__text bf-2__text_small'>
            Столкнулись с проблемой&nbsp;— сообщите о ней!
          </span >
      </div >

      <div class='bf-2__btn-wrap'>
        <!-- pos-banner-btn_2 не удалять; другие классы не добавлять -->
        <button
          class='pos-banner-btn_2'
          type='button'
        >Сообщить о проблеме
        </button >
      </div >

    </div >
    </div >
  </div >
</div >

<script>

(function(){
"use strict";function ownKeys(e,t){var o=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);if(t)n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable});o.push.apply(o,n)}return o}function _objectSpread(e){for(var t=1;t<arguments.length;t++){var o=null!=arguments[t]?arguments[t]:{};if(t%2)ownKeys(Object(o),true).forEach(function(t){_defineProperty(e,t,o[t])});else if(Object.getOwnPropertyDescriptors)Object.defineProperties(e,Object.getOwnPropertyDescriptors(o));else ownKeys(Object(o)).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(o,t))})}return e}function _defineProperty(e,t,o){if(t in e)Object.defineProperty(e,t,{value:o,enumerable:true,configurable:true,writable:true});else e[t]=o;return e}var POS_PREFIX_2="--pos-banner-fluid-2__",posOptionsInitial={"grid-template-columns":"100%","grid-template-rows":"310px auto","decor-grid-column":"initial","decor-grid-row":"initial","decor-padding":"30px 30px 0 30px","bg-url":"url('https://pos.gosuslugi.ru/bin/banner-fluid/2/banner-fluid-bg-2-small.svg')","bg-position":"calc(10% + 64px) calc(100% - 20px)","bg-size":"cover","content-padding":"0 30px 30px 30px","slogan-font-size":"20px","slogan-line-height":"32px","logo-wrap-padding":"20px 30px 30px 40px","logo-wrap-top":"0","logo-wrap-bottom":"initial","logo-wrap-border-radius":"0 0 0 80px"},setStyles=function(e,t){Object.keys(e).forEach(function(o){t.style.setProperty(POS_PREFIX_2+o,e[o])})},removeStyles=function(e,t){Object.keys(e).forEach(function(e){t.style.removeProperty(POS_PREFIX_2+e)})};function changePosBannerOnResize(){var e=document.documentElement,t=_objectSpread({},posOptionsInitial),o=document.getElementById("js-show-iframe-wrapper"),n=o?o.offsetWidth:document.body.offsetWidth;if(n>405)t["slogan-font-size"]="24px",t["logo-wrap-padding"]="30px 50px 30px 70px";if(n>500)t["grid-template-columns"]="min-content 1fr",t["grid-template-rows"]="100%",t["decor-grid-column"]="2",t["decor-grid-row"]="1",t["decor-padding"]="30px 30px 30px 0",t["content-padding"]="30px",t["bg-position"]="0% calc(100% - 70px)",t["logo-wrap-padding"]="30px 30px 24px 40px",t["logo-wrap-top"]="initial",t["logo-wrap-bottom"]="0",t["logo-wrap-border-radius"]="80px 0 0 0";if(n>585)t["bg-position"]="0% calc(100% - 6px)";if(n>800)t["bg-url"]="url('https://pos.gosuslugi.ru/bin/banner-fluid/2/banner-fluid-bg-2.svg')",t["bg-position"]="0% center";if(n>1020)t["slogan-font-size"]="32px",t["line-height"]="40px",t["logo-wrap-padding"]="30px 30px 24px 50px";setStyles(t,e)}changePosBannerOnResize(),window.addEventListener("resize",changePosBannerOnResize),window.onunload=function(){var e=document.documentElement;window.removeEventListener("resize",changePosBannerOnResize),removeStyles(posOptionsInitial,e)};
})()
</script>
 <script>Widget("https://pos.gosuslugi.ru/form", 256473)</script>

 

    <!-- <a href="https://www.gosuslugi.ru/"><img src="/sources/left_menu/gosuslugi.png" alt="image"></a> -->
</div>


