import pytest
from selenium import webdriver
from pages.requisiciones_create_page import Requisiciones_create


def test_requisiciones_create(browser):
    #LOGIN
    requisiciones_create_page= Requisiciones_create(browser)
    requisiciones_create_page.login("zaid.garcia@becarios.silent4business.com","Administrador2")
    #MENÚ HAMBURGUESA
    requisiciones_create_page.open_menu()
    #GESTION CONTRACTUAL
    requisiciones_create_page.go_to_gestion_contractual()
    #REQUISICIONES
    requisiciones_create_page.requisiciones_module()
    #REQUSICIONES CREATE
    requisiciones_create_page.requisiciones_create()
    #FECHA INICIO
    fecha_solicitud = "2022-05-01"
    requisiciones_create_page.fecha_solicitud(fecha_solicitud)
    #RAZÓN SOCIAL
    requisiciones_create_page.razon_social()
    #TITULO REQUISICIÓN
    titulo_requisicion = "TEST"
    requisiciones_create_page.titulo_requisicion(titulo_requisicion)
    #COMPRADOR
    requisiciones_create_page.comprador()
    #PROYECTO
    proyecto = "/ KONFIO_PENTEST_001_21 - Servicios de Pruebas de Penetración"
    requisiciones_create_page.proyecto(proyecto)
