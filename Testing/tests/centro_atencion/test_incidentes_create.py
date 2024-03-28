import pytest
from selenium import webdriver
from pages.centro_atencion.incidentes.incidentes_create import IncidentesCreate


def test_centro_atencion_index(browser):
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
