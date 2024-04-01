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
    #AREAS AFECTADAS
    areas = "Desarrollo"
    incidentes_create.areas_afectadas(areas)
