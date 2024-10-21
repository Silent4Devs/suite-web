import pytest
from selenium import webdriver
from selenium.webdriver.firefox.options import Options

@pytest.fixture
def browser():
    options = Options()
    options.headless = True  # Ejecución en modo headless
    options.add_argument("--disable-dev-shm-usage")  # Deshabilita el uso de la memoria compartida
    options.add_argument("--no-sandbox")  # Evita problemas de sandbox
    options.add_argument("--ignore-certificate-errors")  # Ignora errores de certificado SSL

    driver = webdriver.Firefox(options=options)
    driver.maximize_window()
    driver.implicitly_wait(10)
    yield driver
    driver.quit()




