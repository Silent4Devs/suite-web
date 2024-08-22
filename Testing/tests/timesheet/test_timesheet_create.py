import pytest
from selenium import webdriver
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.timesheet.create.timesheet_create import TimesheetCreate
from config import username, password

@pytest.fixture(scope="session")
def browser():
    options = FirefoxOptions()
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

def test_timesheet_create(browser):
    timesheet_create = TimesheetCreate(browser)
    app_url='https://192.168.9.78/'
    username_input = "input[name='email']"
    password_input = "input[name='password']"
    btn_enviar = "//button[@type='submit'][contains(text(),'Enviar')]"
    logo = "img[alt='Logo Tabantaj']"
    timesheet_create.login(app_url,logo, btn_enviar, username_input, password_input)

    timesheet_create = 'https://192.168.9.78/admin/timesheet/create'
    timesheet_create.index(timesheet_create)
