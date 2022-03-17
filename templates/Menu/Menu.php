<div class="menu_wrapper">
    <div class="menu" id="main_menu">
    </div>
</div>


<script>
    const menu = document.getElementById('main_menu')
    const menuLists= {
        "Главная":{
            'Акредитация': "/pages/main/accreditation/accreditation.php",
            'World Skills': "/pages/main/world_skills/world_skills.php",
            'Историческая справка':"/pages/main/historical_background/historical_background.php",
            'Нормативные документы':"/pages/main/regulatory_document/regulatory_document.php",
            'Учебный процесс':"/pages/main/educational_process/educational_process.php",
            'Наша гордость':"/pages/main/our_pride/our_pride.php",
            'Родителям':"/pages/main/parents/parents.php",
            'Общежитие':"/pages/main/hostel/hostel.php",
            'Вакансии':"/pages/main/job_openings/job_openings.php",
            'Сезонная школа':"/pages/main/seasonal_school/seasonal_school.php",
            'Центр содействия трудоустройства выпускников':"/pages/main/graduate_employment_assistance_center/graduate_employment_assistance_center.php",
            'Социально-воспитательные работы':"/pages/main/social_and_educational_work/social_and_educational_work.php",
            'Информация по ГС ЧС':"/pages/main/information_on_emergency_situations/information_on_emergency_situations.php",
            'Конкурсы':"/pages/main/contests/contests.php",
        },
        
        "Контакты":{
            
        },
        "Студенту":{
            'График учебной и произвоственной практики':"/",
            'График промежуточных и итоговых аттестаций':"/",
            'Предметные кружки и студенческое научное общество':"/",
            'Психологическая помощь':"/",
            'Спортивная жизнь':"/",
            'Студенческий профсоюз':"/",
        },
        "Блог директора":{
            'B' : "/pages/blog_dir/blog_dir.php"

        },
        "Сведения об образовательно организации":{
            'Основные сведения':"/",
            'Структура и органы управления образовательной организацией':"/",
            'Образование':"/",
            'Образовательные стандарты':"/",
            'Руководство. Педагогический состав':"/",
            'Материально техническое обеспечение и оснащение образовательного процесса':"/",
            'Стипендии и иные виды материальной помощи':"/",
            'Платные образовательный услуги':"/",
            'Финансово-хозяйственная деятельность':"/",
            'Вакантые места для приема (перевода)':"/",
            'Доступная среда':"/",
            'Международое сотрудничество':"/",
            'Документы':"/",
        },
        "Поступающему":{

        },
        "Библиотека":{
            'О библиотеке':"/",
            'К читателю':"/",
            'Знаменательные даты':"/",
            'Электорнная библиотека колледжа':"/",
        },
        "Отделение повышения квалификации":{
            'Основные сведения':"/",
            'План учебных циклов':"/",
            'Национальный стандарты':"/",
            'Федеральные нормативные акты':"/",
            'Образовательный программы':"/",
            'Электронное обучение':"/",
            'Выбор учебного цикла':"/",
            'Переень несертификационных циклов':"/",
            'Новые циклы':"/",
            'Форма заявок на обучение':"/",
            'Заявление слушателя':"/",
            'Объемы умений и навыков':"/",
            'Памятка слушателя':"/",
            'Экзаменационные вопросы':"/",
        },
    }

    Object.keys(menuLists).map(key => {
        const tempMenuList = document.createElement('div')
        const tempDiv = document.createElement('div')
        
        tempDiv.textContent = key

        tempMenuList.className = 'menu__list list_noactive'

        Object.keys(menuLists[key]).map((ind) => {
            const tempList = document.createElement('div')
            const tempA = document.createElement('a')

            tempList.className = 'list'
            tempList.textContent = ind

            tempA.href = menuLists[key][ind]

            tempA.append(tempList)
            tempMenuList.append(tempA)
        })

        tempDiv.onmouseover = e => {
            // console.log('width',getComputedStyle(tempDiv).width);
            tempMenuList.style.width = getComputedStyle(tempDiv).width
            tempMenuList.classList.remove('list_noactive');
            tempMenuList.classList.add('list_active');
            //  console.log(tempMenuList.classList); 
        }

        tempDiv.onmouseout = e => {
            tempMenuList.classList.remove('list_active'); 
            tempMenuList.classList.add('list_noactive');
        }
        
        tempDiv.append(tempMenuList)
        menu.append(tempDiv)
    })
</script>