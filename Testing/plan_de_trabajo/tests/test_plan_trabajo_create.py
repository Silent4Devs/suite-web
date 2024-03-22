import pytest
from selenium import webdriver
from pages.plan_trabajo_create import PlanTrabajo_create


def test_plan_de_trabajo_index(browser):
    #LOGIN
    plan_trabajo_create= PlanTrabajo_create(browser)
    plan_trabajo_create.login("zaid.garcia@becarios.silent4business.com","Administrador2")
    #MENÚ HAMBURGUESA
    plan_trabajo_create.open_menu()
    #OPCION PLAN DE TRABAJO
    plan_trabajo_create.plan_trabajo()
    #CREATE PLAN DE TRABAJO
    plan_trabajo_create.plan_trabajo_create()
    #INPUT NOMBRE
    nombre="TEST1"
    plan_trabajo_create.input_nombre_create(nombre)
    #SELECT NORMA
    plan_trabajo_create.select_norma_create()
    #INPUT OBJETIVO
    objetivo="OBJETIVO DE PRUEBA"
    plan_trabajo_create.input_objetivo_create(objetivo)
