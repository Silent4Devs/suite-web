import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.centro_atencion.incidentes.incidentes_create import IncidentesCreate

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

def test_incidentes_create(browser):
    #INITIALIZE PAGE OBJECT
    incidentes_create= IncidentesCreate(browser)
    #LOGIN
    incidentes_create.login()
    #OPEN MENU
    incidentes_create.open_menu()
    #NAVIGATE TO CENTRO DE ATENCION
    incidentes_create.navigate_to_centro_atencion()
    #CLICK MODULES
    incidentes_create.click_incidentes_module()
    #CREAR REPORTE
    incidentes_create.crear_reporte()
    #TITLE
    titulo = "Incidente de Prueba"
    incidentes_create.titulo_incidente(titulo)
    #FECHA
    fecha = "2024-03-28T12:00"
    incidentes_create.seleccionar_fecha(fecha)
    #sede
    incidentes_create.sede("Torre Murano")
    #UBICACION
    ubicacion = "Piso 4"
    incidentes_create.ubicacion(ubicacion)
    #DESCRIPCION
    descripcion = "Descripción de prueba"
    incidentes_create.descripcion(descripcion)
    # Seleccionar el área afectada en el índice 2
    indice_area = 2
    incidentes_create.areas_afectadas(indice_area)

# Seleccionar el proceso afectado en el índice 3
    indice_proceso = 3
    incidentes_create.procesos_afectados(indice_proceso)

