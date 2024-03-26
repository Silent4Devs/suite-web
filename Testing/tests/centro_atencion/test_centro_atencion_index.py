import pytest
from selenium import webdriver
from testing.pages.centro_atencion.index.centro_atencion_index import CentroAtencion_Index


def test_centro_atencion_index(browser):
    #LOGIN
    centro_atencion_index = CentroAtencion_Index(browser)
    centro_atencion_index.login("zaid.garcia@becarios.silent4business.com","Administrador2")
    #MENÚ HAMBURGUESA
    centro_atencion_index.open_menu()
    #CENTRO DE ATENCIÓN
    centro_atencion_index.centro_atencion()
