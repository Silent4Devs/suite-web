import pytest
import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

@pytest.fixture(scope="module")
def browser():
    driver = webdriver.Firefox()
    yield driver
    driver.quit()

def login(driver):
    driver.get('https://192.168.9.78/')
    driver.maximize_window()
    print("------ LOGIN - TABANTAJ -----")
    time.sleep(5)
    registro_visitantes = WebDriverWait(driver, 3).until(
        EC.visibility_of_element_located((By.XPATH, "//a[contains(.,'Registro de Visitantes')]"))
    )
    print("Ingresando a registro de visitantes")
    registro_visitantes.click()
    print("URL actual:", driver.current_url)
    time.sleep(5)
    url = "https://192.168.9.78/admin/visitantes?perPage=5"
    driver.get(url)
    time.sleep(5)
    print("URL actual:", driver.current_url)
    # Verificar si la URL es la esperada
    if driver.current_url != url:
        print("Se redireccionó a una URL inesperada:", driver.current_url)
    else:
        print("La URL es la esperada:", driver.current_url)

def test_login(browser):

    login(browser)


