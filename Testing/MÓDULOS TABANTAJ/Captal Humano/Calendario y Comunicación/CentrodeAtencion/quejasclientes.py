from selenium import webdriver
import os
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import TimeoutException
import time
tiempo_espera2=15
tiempo_modulos=5
tiempo_carga=10
tiempo_espera=2.5
#driver Firefox
driver=webdriver.Firefox()

#Open URL
driver.get('https://192.168.9.78/admin/capital-humano')

#Maximize Window
driver.maximize_window()
time.sleep(5)

#Login
usr=driver.find_element(By.XPATH,"//INPUT[@id='email']").send_keys("cesar.escobar@silent4business.com")
time.sleep(tiempo_modulos)
pw=driver.find_element(By.XPATH,"//INPUT[@id='password']").send_keys("6&b5lzoX!E")
time.sleep(tiempo_modulos)
btn=driver.find_element(By.XPATH,"//button[@type='submit'][contains(.,'Enviar')]")
btn.click()

time.sleep(tiempo_modulos)

#Entrar a modulos

modulo=driver.find_element(By.XPATH,"//A[@id='nav-calendario-comunicacion-tab']")
modulo.click()
modulo_calendario=driver.find_element(By.XPATH,"(//A[@href='https://192.168.9.78/admin/desk'])[2]").click()
time.sleep(tiempo_carga)

#Entrar a submodulo Quejas Clientes
modulo_calendario=driver.find_element(By.XPATH,"(//A[@href='#'])[11]").click()
time.sleep(tiempo_modulos)

#Usar boton agregar Quejas Clientes
btncrear_reporte=driver.find_element(By.XPATH,"(//A[@class='btn btn-danger'][text()='Crear reporte'])[4]").click()
time.sleep(tiempo_carga)

#Llenar campos obligatorios para Quejas Clientes

campo_cliente=driver.find_element(By.XPATH,"(//SELECT[@class='form-control '])[1]").send_keys("BANSEFI")
time.sleep(tiempo_modulos)

campo_proyecto=driver.find_element(By.XPATH,"(//SELECT[@class='form-control'])[1]").send_keys("DG")
time.sleep(tiempo_modulos)

campo_nombre_decontacto=driver.find_element(By.XPATH,"(//INPUT[@type='text'])[1]").send_keys("César Escobar")
time.sleep(tiempo_modulos)

campo_puesto=driver.find_element(By.XPATH,"(//INPUT[@type='text'])[2]").send_keys("PUESTO DE PRUEBA")
time.sleep(tiempo_modulos)

campo_telefono=driver.find_element(By.XPATH,"(//INPUT[@type='text'])[3]").send_keys("7223211122")
time.sleep(tiempo_modulos)

campo_electronico=driver.find_element(By.XPATH,"(//INPUT[@type='text'])[4]").send_keys("prueba@prueba.com")
time.sleep(tiempo_modulos)


btn_areas=driver.find_element(By.XPATH,"(//SELECT[@class='form-control'])[2]").send_keys("Desarrollo")
time.sleep(tiempo_espera)

btn_coloboradores=driver.find_element(By.XPATH,"(//SELECT[@class='form-control'])[3]").send_keys("César Ernesto Escobar Hernández")
time.sleep(tiempo_espera)

btn_procesos=driver.find_element(By.XPATH,"(//SELECT[@class='form-control'])[4]").send_keys("P-SGI-007: Ciberinteligencia")
time.sleep(tiempo_espera)

btn_otros=driver.find_element(By.XPATH,"//TEXTAREA[@name='otro_quejado']").send_keys("Campo de Prueba")
time.sleep(tiempo_espera)


campo_titulo=driver.find_element(By.XPATH,"(//INPUT[@type=''])[1]").send_keys("TITULO DE PRUEBA")
time.sleep(tiempo_modulos)

campo_fecha_hora=driver.find_element(By.XPATH,"//INPUT[@type='datetime-local']").send_keys("17/12/1998 04:30 a.m")
time.sleep(tiempo_modulos)

campo_ubicacion_fisica=driver.find_element(By.XPATH,"(//INPUT[@type=''])[2]").send_keys("UBICACION FISICA DE PRUEBA")
time.sleep(tiempo_modulos)

campo_canal_de_resepcion=driver.find_element(By.XPATH,"//SELECT[@id='otros_campo']").send_keys("Presencial")
time.sleep(tiempo_modulos)

campo_descripcion_detallada_delaqueja=driver.find_element(By.XPATH,"//TEXTAREA[@type='text']").send_keys("DESCRIPCION DETALLADA DE LA QUEJA DE PRUEBA")
time.sleep(tiempo_modulos)

campo_solucion_que_requiere_elcliente=driver.find_element(By.XPATH,"//TEXTAREA[@name='solucion_requerida_cliente']").send_keys("SOLUCION QUE REQUIERE EL CLIENTE DE PRUEBA")
time.sleep(tiempo_modulos)

campo_comentarios_del_receptor=driver.find_element(By.XPATH,"//TEXTAREA[@name='comentarios']").send_keys("COMENTARIOS DEL RECEPTOR DE PRUEBA")
time.sleep(tiempo_modulos)


#btnopcion_multiple_si=driver.find_element(By.XPATH,"(//DIV[@class='form-check'])[1]").click()
btnopcion_multiple_no=driver.find_element(By.XPATH,"//INPUT[@id='correo_cliente']").click()
time.sleep(tiempo_carga)

#Enviar Cambios 
btnguardar=driver.find_element(By.XPATH,"//INPUT[@type='submit']").click()