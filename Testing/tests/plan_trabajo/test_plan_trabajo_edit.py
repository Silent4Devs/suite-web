import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.plan_trabajo.edit.plan_trabajo_edit import PlanTrabajo_edit

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

def test_plan_de_trabajo_edit(browser):
    #LOGIN
    plan_trabajo_edit= PlanTrabajo_edit(browser)
    plan_trabajo_edit.login()
    #MENÚ HAMBURGUESA
    plan_trabajo_edit.open_menu()
    #OPCION PLAN DE TRABAJO
    plan_trabajo_edit.plan_trabajo()
    #OPCIONES
    plan_trabajo_edit.plan_trabajo_opciones()
    #EDITAR
    plan_trabajo_edit.plan_trabajo_editar()
    #EDITAR NOMBRE
    nombre_edit="EDITAR NOMBRE PLAN DE TRABAJO"
    plan_trabajo_edit.input_edit_nombre(nombre_edit)
    #FECHA INICIO
    fecha = "2024-03-04"
    plan_trabajo_edit.seleccionar_fecha_inicio(fecha)
    #FECHA FIN
    fecha = "2024-03-04"
    plan_trabajo_edit.seleccionar_fecha_fin(fecha)
    #DESCRIPCIÓN
    descripcion="TEST1"
    plan_trabajo_edit.descripcion(descripcion)
    #GUARDAR BTN
    plan_trabajo_edit.guardar_btn()
