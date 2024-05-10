import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.requisiciones.index.requisiciones_index_page import Requisiciones_index

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

def test_requisiciones_index(browser):
    #LOGIN
    requisiciones_index_page= Requisiciones_index(browser)
    requisiciones_index_page.login()
    #MENÚ HAMBURGUESA
    requisiciones_index_page.open_menu()
    #GESTION CONTRACTUAL
    requisiciones_index_page.go_to_gestion_contractual()
    #REQUISICIONES
    requisiciones_index_page.requisiciones_module()
    #FILTRO
    requisiciones_index_page.requisiciones_filtro()
    #BARRA DE BÚSQUEDA
    search="TEST"
    requisiciones_index_page.requisiciones_searchbar(search)
    #APROBADORES BTN
    requisiciones_index_page.requisiciones_aprobadores()
    #ARCHIVADOS BTN
    requisiciones_index_page.requisiciones_archivados()
    #CSV
    requisiciones_index_page.requisiciones_download_csv()
    #EXCEL
    requisiciones_index_page.requisiciones_download_excel()
    #PDF
    requisiciones_index_page.requisiciones_download_pdf()
    #PRINT
    requisiciones_index_page.requisiciones_print()
