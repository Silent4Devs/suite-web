import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.timesheet.admin.dashboard.historic.dashboard_proyectos import DashboardProyectos
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

def test_dashboard_proyectos(browser):
    timesheet_dashboardempleados = DashboardProyectos(browser)
    username_input = "input[name='email']"
    password_input = "input[name='password']"
    btn_enviar = "//button[@type='submit'][contains(text(),'Enviar')]"
    logo="img[alt='Logo Tabantaj']"
    timesheet_dashboardempleados.login(logo,btn_enviar,username_input,password_input)

    dashboard_route = "https://192.168.9.78/admin/timesheet/dashboard"
    timesheet_dashboardempleados.timesheet_dashboard_index(dashboard_route)

    proyectos_section="//a[@class='nav-link'][contains(.,'Proyectos')]"
    timesheet_dashboardempleados.proyectos_section(proyectos_section)


