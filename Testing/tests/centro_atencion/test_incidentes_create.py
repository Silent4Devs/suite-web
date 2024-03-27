import pytest
from selenium import webdriver
from testing.pages.centro_atencion.incidentes.incidentes_create import IncidentesCreate


def test_centro_atencion_index(browser):
    #INITIALIZE PAGE OBJECT
    centro_atencion_index = IncidentesCreate(browser)
    #LOGIN
    centro_atencion_index.login()
    #OPEN MENU
    centro_atencion_index.open_menu()
    #NAVIGATE TO CENTRO DE ATENCION
    centro_atencion_index.navigate_to_centro_atencion()
    #CLICK MODULES
    centro_atencion_index.click_incidentes_module()
