import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Citas from '../views/Citas.vue'
import Agenda from '../views/Agenda.vue'
import Pacientes from '../views/Paciente.vue'
import Medicos from '../views/Medico.vue'

const routes = [
  {
    path: '/home',
    name: 'home',
    component: HomeView
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path: '/',
    name: 'usuarios',
    // component: usuarios
    component: () => import(/* webpackChunkName: "usuarios" */ '../views/Usuarios.vue')
  },
  {
    path: '/citas',
    name: 'citas',
    component: Citas
  },
  {
    path: '/agenda',
    name: 'agenda',
    component: Agenda
  },
  {
    path: '/pacientes',
    name: 'pacientes',
    component: Pacientes
  },
  {
    path: '/medicos',
    name: 'medicos',
    component: Medicos
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
