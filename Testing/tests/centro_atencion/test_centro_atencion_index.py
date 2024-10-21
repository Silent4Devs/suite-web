import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.centro_atencion.index.centro_atencion_index import CentroAtencionIndex

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

def test_centro_atencion_index(browser):
    #INITIALIZE PAGE OBJECT
    centro_atencion_index = CentroAtencionIndex(browser)
    #LOGIN
    centro_atencion_index.login()
    #OPEN MENU
    centro_atencion_index.open_menu()
    #NAVIGATE TO CENTRO DE ATENCION
    centro_atencion_index.navigate_to_centro_atencion()
    #CLICK MODULES
    centro_atencion_index.click_incidentes_module()
    centro_atencion_index.click_riesgos_module()
    centro_atencion_index.click_quejas_module()
    centro_atencion_index.click_quejas_clientes_module()
    centro_atencion_index.click_denuncias_module()
    centro_atencion_index.click_mejoras_module()
    centro_atencion_index.click_sugerencias_module()

    centro_atencion_index.click_quejas_module()

    #centro_atencion_index.mostrar_filtro("10")
    centro_atencion_index.export_csv()
    centro_atencion_index.export_excel()
    centro_atencion_index.imprimir()
    centro_atencion_index.pdf()

