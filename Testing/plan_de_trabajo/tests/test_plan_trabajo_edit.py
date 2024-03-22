import pytest
from selenium import webdriver
from pages.plan_trabajo_edit import PlanTrabajo_edit


def test_plan_de_trabajo_edit(browser):
    #LOGIN
    plan_trabajo_edit= PlanTrabajo_edit(browser)
    plan_trabajo_edit.login("zaid.garcia@becarios.silent4business.com","Administrador2")
    #MENÚ HAMBURGUESA
    plan_trabajo_edit.open_menu()
    #OPCION PLAN DE TRABAJO
    plan_trabajo_edit.plan_trabajo()
    #OPCIONES
    plan_trabajo_edit.plan_trabajo_opciones()
    #EDITAR
    plan_trabajo_edit.plan_trabajo_editar()
    #EDITAR NOMBRE
    nombre_edit="EDITAR NOMBRE PLAN DE TRABAJO"
    plan_trabajo_edit.input_edit_nombre(nombre_edit)
