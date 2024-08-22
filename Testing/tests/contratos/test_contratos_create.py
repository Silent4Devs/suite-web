import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.contratos.create.contratos_create_page import ContratosCreate

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

def test_contratos(browser):
    contratos_create_page = ContratosCreate(browser)
    contratos_create_page.login()
    #MENÚ HAMBURGUESA
    contratos_create_page.open_menu()
    #GESTIÓN CONTRACTUAL
    contratos_create_page.go_to_gestion_contractual()
    #CONTRATOS
    contratos_create_page.go_to_contratos()
    #AGREGAR CONTRATO
    contratos_create_page.agregar_contrato()
    #NUMERO DE CONTRATO
    numero_contrato ="GREBREREBTERGFW3E452345"
    contratos_create_page.numero_contrato(numero_contrato)
    #TIPO DE CONTRATO
    contratos_create_page.tipo_contrato()
    #NOMBRE DE SERVICIO
    nombre_servicio = "Servicio de Prueba"
    contratos_create_page.nombre_servicio(nombre_servicio)
    #NOMBRE CLIENTE
    contratos_create_page.nombre_cliente()
    #NUMERO PROVEEDOR
    numero_proveedor = "123456"
    contratos_create_page.numero_proveedor(numero_proveedor)
    #AREA CONTRATO
    contratos_create_page.area_contrato()
    #FASE
    contratos_create_page.fase()
    #ESTATUS
    contratos_create_page.estatus()
    #OBJETIVO DEL SERVICIO
    objetivo_servicio = "Objetivo de Prueba"
    contratos_create_page.objetivo_servicio(objetivo_servicio)
    #ADJUNTAR ARCHIVO
    contratos_create_page.adjuntar_contrato()
    #VIGENCIA
    contratos_create_page.vigencia()
    #FECHA INICIO
    fecha_inicio = "2022-05-01"
    contratos_create_page.fecha_inicio(fecha_inicio)
    #FECHA FIN
    fecha_fin = "2023-05-07"
    contratos_create_page.fecha_fin(fecha_fin)
    #FECHA FIRMA
    fecha_firma = "2022-05-05"
    contratos_create_page.fecha_firma(fecha_firma)
    #NUMERO DE PAGOS
    numero_pagos = "1"
    contratos_create_page.numero_pagos(numero_pagos)
    #TIPO DE CAMBIO
    contratos_create_page.tipo_cambio()
    #MONTO DE PAGO
    monto_de_pago = "1000"
    contratos_create_page.monto_de_pago(monto_de_pago)
    #MONTO MAXIMO
    monto_maximo = "1000000"
    contratos_create_page.monto_maximo(monto_maximo)
    #MONTO MÍNIMO
    monto_minimo = "100"
    contratos_create_page.monto_minimo(monto_minimo)
    #SUPERVISOR 1
    supervisor_1 = "Supervisor 1"
    contratos_create_page.supervisor_1(supervisor_1)
    #PUESTO SUPERVISOR 1
    puesto_supervisor_1 = "Puesto Supervisor 1"
    contratos_create_page.puesto_supervisor_1(puesto_supervisor_1)
    #AREA SUPERVISOR 1
    area_supervisor_1 = "Area Supervisor 1"
    contratos_create_page.area_supervisor_1(area_supervisor_1)
    #SUPERVISOR 2
    supervisor_2 = "Supervisor 2"
    contratos_create_page.supervisor_2(supervisor_2)
    #PUESTO SUPERVISOR 2
    puesto_supervisor_2 = "Puesto Supervisor 2"
    contratos_create_page.puesto_supervisor_2(puesto_supervisor_2)
    #AREA SUPERVISOR 2
    area_supervisor_2 = "Area Supervisor 2"
    contratos_create_page.area_supervisor_2(area_supervisor_2)
    #GUARDAR BOTÓN
    contratos_create_page.guardar()
