import Vue from "vue"
import { AclInstaller, AclCreate, AclRule } from "vue-acl"
import router from "@/router"

Vue.use(AclInstaller)

let initialRole = "public"

let userInfo = JSON.parse(localStorage.getItem("userInfo"))
if(userInfo && userInfo.rule) initialRole = userInfo.rule

export default new AclCreate({
  initial: initialRole,
  notfound: "/pages/not-authorized",
  router,
  acceptLocalRules: true,
  globalRules: {
    admin: new AclRule("admin").generate(),
    operator: new AclRule("operator").or("admin").generate(),
    captain: new AclRule("captain").or("operator").or("admin").generate(),
    customer: new AclRule("customer").or("captain").or("operator").or("admin").generate(),
    public: new AclRule("public").or("customer").or("captain").or("operator").or("admin").generate(),
  }
})
