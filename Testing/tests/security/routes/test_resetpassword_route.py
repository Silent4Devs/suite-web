import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from routes.login.login_resetpassword_route import ResetPasswordRoute

@pytest.fixture(scope="session")
def browser():
    #options = ChromeOptions()
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

def test_resetpassword_route(browser):
    #INITIALIZE PAGE OBJECT
        login_resetpassword_route =ResetPasswordRoute(browser)
        login_resetpassword_route.login_route()
        login_resetpassword_route.is_https()
