import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from testing.pages.timesheet.admin.dashboard.historic.dashboard_registrotimesheet import DashboardRegistrosTimesheet
from config import username, password

@pytest.fixture(scope="session")
def browser():
    options = FirefoxOptions()
    # options = ChromeOptions()
    options.add_argument('--headless')
    options.add_argument('--disable-gpu')
    options.add_argument('--no-sandbox')
    options.add_argument('--disable-dev-shm-usage')

    options.add_argument('--disable-extensions')
    options.add_argument('--disable-dev-shm-usage')
    options.add_argument('--disable-browser-side-navigation')
    options.add_argument('--disable-gpu')
    options.add_argument('--no-sandbox')
    options.add_argument('--log-level=3')

    #driver = webdriver.Chrome(options=options)
    driver = webdriver.Firefox(options=options)
    yield driver
    driver.quit()

def test_timesheet_dashboard(browser):
    timesheet_dashboard = DashboardRegistrosTimesheet(browser)
    username_input = "input[name='email']"
    password_input = "input[name='password']"
    btn_enviar = "//button[@type='submit'][contains(text(),'Enviar')]"
    logo="img[alt='Logo Tabantaj']"
    timesheet_dashboard.login(logo,btn_enviar,username_input,password_input)

    dashboard_route = "https://192.168.9.78/admin/timesheet/dashboard"
    timesheet_dashboard.timesheet_dashboard_index(dashboard_route)

    select1 = "//select[@class='form-control' and @id='areas-graf-areas-time']"
    registro1 = "QA"
    timesheet_dashboard.registros_timesheet_area_select_graphic(select1,registro1)

    select2="//select[contains(@id,'areas-graf-registros-general')]"
    registro2 = "QA"
    timesheet_dashboard.registro_timesheet_select_graphic(select2,registro2)

    select3 = "//select[contains(@id,'graf-registros-area')]"
    registro3 = "QA"
    timesheet_dashboard.registro_horas_area_select_graphic(select3,registro3)

    empleados = "//a[@class='nav-link' and @id='nav-empleados-tab'][normalize-space()='Empleados']"
    timesheet_dashboard.empleados_section(empleados)
