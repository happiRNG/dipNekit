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
            '0':"/",
        },
        "Контакты":{
            '0' : "/pages/contacts/contacts.php" ,
            
        },
        "Студенту":{
            'График учебной и произвоственной практики':"/pages/students/schedule_of_education/schedule_of_education.php",
            'График промежуточных и итоговых аттестаций':"/pages/students/certification_schedule/certification_schedule.php",
            'Предметные кружки и студенческое научное общество':"/pages/students/circles/circles.php",
            'Психологическая помощь':"/pages/students/psychological_help/psychological_help.php",
            'Спортивная жизнь':"/pages/students/sport_life/sport_life.php",
            'Студенческий профсоюз':"/pages/students/trade_union_organization/trade_union_organization.php",
        },
        "Блог директора":{
            'B' : "/pages/blog_dir/blog_dir.php",
            
        },
        "Сведения об образовательно организации":{
            'Основные сведения':"/pages/information_about_the_organization/information_basic/information_basic.php",
            'Структура и органы управления образовательной организацией':"/pages/information_about_the_organization/college_structure/college_structure.php",
            'Документы' :"/pages/information_about_the_organization/document/document.php",
            'Образование':"/pages/information_about_the_organization/education/education.php",
            'Образовательные стандарты':"/pages/information_about_the_organization/educational_standards/educational_standards.php",
            'Руководство. Педагогический состав':"/pages/information_about_the_organization/management/management.php",
            'Материально техническое обеспечение и оснащение образовательного процесса':"/pages/information_about_the_organization/logistics/logistics.php",
            'Стипендии и иные виды материальной помощи':"/pages/information_about_the_organization/scholarship/scholarship.php",
            'Платные образовательный услуги':"/pages/information_about_the_organization/paid_training/paid_training.php",
            'Финансово-хозяйственная деятельность':"/pages/information_about_the_organization/economic_activity/economic_activity.php",
            'Вакантые места для приема (перевода)':"/pages/information_about_the_organization/vacancies/vacancies.php",
            'Доступная среда':"/pages/information_about_the_organization/accessible_environment/accessible_environment.php",
            
        },
        "Поступающему":{
            'incoming' :"/pages/incoming/incoming.php"

        },
        "Библиотека":{
            'О библиотеке':"/pages/lib/about_lib/about_lib.php",
            'К читателю':"/pages/lib/to_reader/to_reader.php",
            'Знаменательные даты':"/pages/lib/date/date.php",
            'Электорнная библиотека колледжа':"/pages/lib/elec_lib/elec_lib.php",
        },
        "Отделение повышения квалификации":{
            'Основные сведения':"/pages/department_training/department_training/department_training.php",
            'План учебных циклов':"/pages/department_training/study_cycle/study_cycle.php",
            'Национальный стандарты':"/pages/department_training/national_standards/national_standards.php",
            'Федеральные нормативные акты':"/pages/department_training/federal_regulations/federal_regulations.php",
            // 'Образовательный программы':"/pages/department_training/",
            'Электронное обучение':"/pages/department_training/elec_education/elec_education.php",
            'Выбор учебного цикла':"/pages/department_training/training_cycle/training_cycle.php",
            // 'Переень несертификационных циклов':"/pages/department_training/",
            'Новые циклы':"/pages/department_training/new_cycle/new_cycle.php",
            // 'Форма заявок на обучение':"/pages/department_training/",
            // 'Заявление слушателя':"/pages/department_training/",
            // 'Объемы умений и навыков':"/pages/department_training/",
            // 'Памятка слушателя':"/pages/department_training/",
            // 'Экзаменационные вопросы':"/pages/department_training/",
        },
    }

    Object.keys(menuLists).map(key => { //проход по разделам меню
        const tempAMain = document.createElement('a')//для того чтобы сделать ссылку на саму кнопку раздела
        const tempMenuList = document.createElement('div') //список пунктов раздела меню
        const tempDiv = document.createElement('div') //Раздел меню
        
        tempDiv.textContent = key
        tempMenuList.className = 'menu__list list_noactive'

        tempAMain.href = menuLists[key]['0']

        Object.keys(menuLists[key]).map((ind) => {
            if (ind === '0') return

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
        tempAMain.append(tempDiv)
        menu.append(tempAMain)
    })
</script>