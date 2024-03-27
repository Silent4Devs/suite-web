import pytest
from selenium import webdriver
from testing.pages.centro_atencion.index.centro_atencion_index import CentroAtencionIndex


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

