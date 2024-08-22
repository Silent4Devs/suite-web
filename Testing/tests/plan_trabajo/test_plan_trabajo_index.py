import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.plan_trabajo.index.plan_trabajo_index import PlanTrabajo_index

@pytest.fixture(scope="session")
def browser():
    options = FirefoxOptions()
    #options = ChromeOptions()
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

def test_plan_de_trabajo_index(browser):
    #LOGIN
    plan_trabajo_index= PlanTrabajo_index(browser)
    plan_trabajo_index.login()
    #MENÚ HAMBURGUESA
    plan_trabajo_index.open_menu()
    #OPCION PLAN DE TRABAJO
    plan_trabajo_index.plan_trabajo()
    #FILTRO
    plan_trabajo_index.plan_trabajo_filtro()
    #BARRA DE BUSQUEDA
    search=""
    plan_trabajo_index.plan_trabajo_searchbar(search)
    #PAGINADO
    plan_trabajo_index.plan_trabajo_paginador()
    #OPCIONES
    plan_trabajo_index.plan_trabajo_opciones()
    #EDITAR
    plan_trabajo_index.plan_trabajo_editar()
    #VER PLAN
    plan_trabajo_index.plan_trabajo_ver_plan()
