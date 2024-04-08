import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.contratos.index.contratos_page import ContratosIndex

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

def test_contratos_index(browser):
    #LOGIN
    contratos_index = ContratosIndex(browser)
    contratos_index.login()

    #MENÚ HAMBURGUESA
    contratos_index.open_menu()
    #GESTION CONTRACTUAL
    contratos_index.go_to_gestion_contractual()
    #CONTRATOS
    contratos_index.go_to_contratos()
    #CONTRATOS DEL ÁREA
    contratos_index.contratos_del_area()
    #BARRA DE BUSQUEDA
    search=""
    contratos_index.search_bar(search)
    #VISUALIZAR
    contratos_index.visualizar()
    #EXPORTAR
    #contratos_page.exportar()

