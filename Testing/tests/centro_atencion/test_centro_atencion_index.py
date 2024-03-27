import pytest
from selenium import webdriver
from testing.pages.centro_atencion.index.centro_atencion_index import CentroAtencionIndex


def test_centro_atencion_index(browser):
    username = "zaid.garcia@becarios.silent4business.com"
    password = "Administrador2."

    # Arrange
    centro_atencion_index = CentroAtencionIndex(browser)

    # Act
    centro_atencion_index.login()
    centro_atencion_index.open_menu()
    centro_atencion_index.navigate_to_centro_atencion()
    centro_atencion_index.click_incidentes_module()
    centro_atencion_index.click_riesgos_module()
    centro_atencion_index.click_quejas_module()
    centro_atencion_index.click_denuncias_module()
    centro_atencion_index.click_mejoras_module()
    centro_atencion_index.click_sugerencias_module()



    centro_atencion_index.mostrar_filtro()
    centro_atencion_index.export_csv()
    centro_atencion_index.export_excel()
    centro_atencion_index.imprimir()
