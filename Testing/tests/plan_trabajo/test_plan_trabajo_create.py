import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.plan_trabajo.create.plan_trabajo_create import PlanTrabajo_create

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

def test_plan_de_trabajo_create(browser):
    #LOGIN
    plan_trabajo_create= PlanTrabajo_create(browser)
    plan_trabajo_create.login()
    #MENÚ HAMBURGUESA
    plan_trabajo_create.open_menu()
    #OPCION PLAN DE TRABAJO
    plan_trabajo_create.plan_trabajo()
    #CREATE PLAN DE TRABAJO
    plan_trabajo_create.plan_trabajo_create()
    #INPUT NOMBRE
    nombre="TEST1"
    plan_trabajo_create.input_nombre_create(nombre)
    #FECHA INICIO
    fecha = "2024-03-04"
    plan_trabajo_create.seleccionar_fecha_inicio(fecha)
    #FECHA FIN
    fecha = "2024-03-04"
    plan_trabajo_create.seleccionar_fecha_fin(fecha)
    #DESCRIPCIÓN
    descripcion="TEST1"
    plan_trabajo_create.descripcion(descripcion)
    #GUARDAR BTN
    plan_trabajo_create.guardar_btn()
