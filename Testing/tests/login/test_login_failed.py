import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.login.incorrect_login_page import IncorrectLoginPage
from config import incorrect_username, incorrect_password

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

def test_incorrect_login(browser):
    #INITIALIZE PAGE OBJECT
    incorrect_login_page=IncorrectLoginPage(browser)
    #LOGIN
    incorrect_login_page.login()

