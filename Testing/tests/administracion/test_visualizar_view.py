from pages.administracion.ajustes_de_sistema.visualizar_logs.view.visualizar_view_page import View_visualizar
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from selenium import webdriver
import pytest
"""
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
    
    driver = webdriver.Firefox(options=options)
    yield driver
    driver.quit()
"""     
def test_visualizar_view(browser):
    
 visualizar_view = View_visualizar(browser)
 visualizar_view.login()
 url_apartado_index = "https://192.168.9.78/admin/visualizar-logs"
 visualizar_view.ruta_visualizar_logs_index(url_apartado_index)



